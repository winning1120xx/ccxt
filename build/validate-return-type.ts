
import ts from 'typescript';
import fs from 'fs'
import log from 'ololog'

const skipMethods = [
    'fetchMarkets'
]

const skipExchanges = [
    'someExchange'
    // place exchanges here
]


const exchanges = JSON.parse (fs.readFileSync("./exchanges.json", "utf8")).ids;

// Function to extract method names and return types from a .d.ts file
function extractMethodsAndReturnTypes(filePath: string): Record<string, string> {
  const program = ts.createProgram([filePath], {});
  const checker = program.getTypeChecker();
  const sourceFile = program.getSourceFile(filePath);

  const methods: Record<string, string> = {};

  function visit(node: ts.Node) {
    if (ts.isMethodSignature(node) || ts.isMethodDeclaration(node)) {
      const methodName = node.name.getText(sourceFile);
      const returnType = checker.typeToString(checker.getReturnTypeOfSignature(checker.getSignatureFromDeclaration(node)!));

      methods[methodName] = returnType;
    }
    ts.forEachChild(node, visit);
  }

  if (sourceFile) {
    visit(sourceFile);
  }
  return methods;
}

function isUserFacingMethod(method: string) {
    return method.startsWith('fetch')
        || method.startsWith('create')
        || method.startsWith('cancel')
        || method.startsWith('edit')
        || method.startsWith('transfer')
        || method.startsWith('withdraw')
        || method.startsWith('deposit');
}

function isUknownReturnType(type: string) {
    return type === 'any'
        || type === 'Promise<{}>'
        || type === 'Promise<unknown>'
        || type === 'Promise<any>'
        || type.startsWith('{')
        || type.startsWith('Promise<{')
}


function main() {
    const basePath = './js/src/';

    const sourceOfTruth = extractMethodsAndReturnTypes(basePath + 'base/Exchange.d.ts');
    let foundIssues = false;
    for (const exchange of exchanges) {
        if (skipExchanges.includes(exchange)) {
            continue;
        }
        const path = basePath + exchange + '.d.ts';
        const methodsInfo = extractMethodsAndReturnTypes(path);
        for (const method in methodsInfo) {
            if (skipMethods.includes(method)) {
                continue;
            }
            const returnType = methodsInfo[method];
            if (method in sourceOfTruth) {
                const targetReturnType = sourceOfTruth[method];
                if (isUserFacingMethod(method)) {
                    if (!isUknownReturnType(targetReturnType)) { // ignore any/untyped methods
                        if (sourceOfTruth[method] !== returnType) {
                            foundIssues = true;
                            log.magenta('Difference found', exchange, method, returnType, targetReturnType);
                        }
                    }
                }
            }
        }
    }
    if (!foundIssues) {
        log.bright.green('No type differences found');
    } else {
        log.bright.red('Type differences found');
        process.exit(1);
    }
}

main()