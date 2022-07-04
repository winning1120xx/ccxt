<?php

namespace ccxt\async;

// PLEASE DO NOT EDIT THIS FILE, IT IS GENERATED AND WILL BE OVERWRITTEN:
// https://github.com/ccxt/ccxt/blob/master/CONTRIBUTING.md#how-to-contribute-code

use Exception; // a common import
use \ccxt\ExchangeError;
use \ccxt\ArgumentsRequired;
use \ccxt\Precise;

class coinone extends Exchange {

    public function describe() {
        return $this->deep_extend(parent::describe (), array(
            'id' => 'coinone',
            'name' => 'CoinOne',
            'countries' => array( 'KR' ), // Korea
            // 'enableRateLimit' => false,
            'rateLimit' => 667,
            'version' => 'v2',
            'has' => array(
                'CORS' => null,
                'spot' => true,
                'margin' => false,
                'swap' => false,
                'future' => false,
                'option' => false,
                'addMargin' => false,
                'cancelOrder' => true,
                'createMarketOrder' => null,
                'createOrder' => true,
                'createReduceOnlyOrder' => false,
                'createStopLimitOrder' => false,
                'createStopMarketOrder' => false,
                'createStopOrder' => false,
                'fetchBalance' => true,
                'fetchBorrowRate' => false,
                'fetchBorrowRateHistories' => false,
                'fetchBorrowRateHistory' => false,
                'fetchBorrowRates' => false,
                'fetchBorrowRatesPerSymbol' => false,
                'fetchClosedOrders' => null, // the endpoint that should return closed orders actually returns trades, https://github.com/ccxt/ccxt/pull/7067
                'fetchDepositAddresses' => true,
                'fetchFundingHistory' => false,
                'fetchFundingRate' => false,
                'fetchFundingRateHistory' => false,
                'fetchFundingRates' => false,
                'fetchIndexOHLCV' => false,
                'fetchLeverage' => false,
                'fetchLeverageTiers' => false,
                'fetchMarginMode' => false,
                'fetchMarkets' => true,
                'fetchMarkOHLCV' => false,
                'fetchMyTrades' => true,
                'fetchOpenInterestHistory' => false,
                'fetchOpenOrders' => true,
                'fetchOrder' => true,
                'fetchOrderBook' => true,
                'fetchPosition' => false,
                'fetchPositionMode' => false,
                'fetchPositions' => false,
                'fetchPositionsRisk' => false,
                'fetchPremiumIndexOHLCV' => false,
                'fetchTicker' => true,
                'fetchTickers' => true,
                'fetchTrades' => true,
                'reduceMargin' => false,
                'setLeverage' => false,
                'setMarginMode' => false,
                'setPositionMode' => false,
            ),
            'urls' => array(
                'logo' => 'https://user-images.githubusercontent.com/1294454/38003300-adc12fba-323f-11e8-8525-725f53c4a659.jpg',
                'api' => 'https://api.coinone.co.kr',
                'www' => 'https://coinone.co.kr',
                'doc' => 'https://doc.coinone.co.kr',
            ),
            'requiredCredentials' => array(
                'apiKey' => true,
                'secret' => true,
            ),
            'api' => array(
                'public' => array(
                    'get' => array(
                        'orderbook/',
                        'trades/',
                        'ticker/',
                    ),
                ),
                'private' => array(
                    'post' => array(
                        'account/deposit_address/',
                        'account/btc_deposit_address/',
                        'account/balance/',
                        'account/daily_balance/',
                        'account/user_info/',
                        'account/virtual_account/',
                        'order/cancel_all/',
                        'order/cancel/',
                        'order/limit_buy/',
                        'order/limit_sell/',
                        'order/complete_orders/',
                        'order/limit_orders/',
                        'order/order_info/',
                        'transaction/auth_number/',
                        'transaction/history/',
                        'transaction/krw/history/',
                        'transaction/btc/',
                        'transaction/coin/',
                    ),
                ),
            ),
            'fees' => array(
                'trading' => array(
                    'tierBased' => false,
                    'percentage' => true,
                    'taker' => 0.002,
                    'maker' => 0.002,
                ),
            ),
            'precision' => array(
                'price' => $this->parse_number('0.0001'),
                'amount' => $this->parse_number('0.0001'),
                'cost' => $this->parse_number('0.00000001'),
            ),
            'precisionMode' => TICK_SIZE,
            'exceptions' => array(
                '405' => '\\ccxt\\OnMaintenance', // array("errorCode":"405","status":"maintenance","result":"error")
                '104' => '\\ccxt\\OrderNotFound', // array("errorCode":"104","errorMsg":"Order id is not exist","result":"error")
                '108' => '\\ccxt\\BadSymbol', // array("errorCode":"108","errorMsg":"Unknown CryptoCurrency","result":"error")
                '107' => '\\ccxt\\BadRequest', // array("errorCode":"107","errorMsg":"Parameter error","result":"error")
            ),
            'commonCurrencies' => array(
                'SOC' => 'Soda Coin',
            ),
        ));
    }

    public function fetch_markets($params = array ()) {
        /**
         * retrieves data on all markets for coinone
         * @param {dict} $params extra parameters specific to the exchange api endpoint
         * @return {[dict]} an array of objects representing market data
         */
        $request = array(
            'currency' => 'all',
        );
        $response = yield $this->publicGetTicker ($request);
        //
        //    {
        //        "result" => "success",
        //        "errorCode" => "0",
        //        "timestamp" => "1643676668",
        //        "xec" => array(
        //          "currency" => "xec",
        //          "first" => "0.0914",
        //          "low" => "0.0894",
        //          "high" => "0.096",
        //          "last" => "0.0937",
        //          "volume" => "1673283662.9797",
        //          "yesterday_first" => "0.0929",
        //          "yesterday_low" => "0.0913",
        //          "yesterday_high" => "0.0978",
        //          "yesterday_last" => "0.0913",
        //          "yesterday_volume" => "1167285865.4571"
        //        ),
        //        ...
        //    }
        //
        $result = array();
        $quoteId = 'krw';
        $quote = $this->safe_currency_code($quoteId);
        $baseIds = is_array($response) ? array_keys($response) : array();
        for ($i = 0; $i < count($baseIds); $i++) {
            $baseId = $baseIds[$i];
            $ticker = $this->safe_value($response, $baseId, array());
            $currency = $this->safe_value($ticker, 'currency');
            if ($currency === null) {
                continue;
            }
            $base = $this->safe_currency_code($baseId);
            $result[] = array(
                'id' => $baseId,
                'symbol' => $base . '/' . $quote,
                'base' => $base,
                'quote' => $quote,
                'settle' => null,
                'baseId' => $baseId,
                'quoteId' => $quoteId,
                'settleId' => null,
                'type' => 'spot',
                'spot' => true,
                'margin' => false,
                'swap' => false,
                'future' => false,
                'option' => false,
                'active' => null,
                'contract' => false,
                'linear' => null,
                'inverse' => null,
                'contractSize' => null,
                'expiry' => null,
                'expiryDatetime' => null,
                'strike' => null,
                'optionType' => null,
                'precision' => array(
                    'amount' => null,
                    'price' => null,
                ),
                'limits' => array(
                    'leverage' => array(
                        'min' => null,
                        'max' => null,
                    ),
                    'amount' => array(
                        'min' => null,
                        'max' => null,
                    ),
                    'price' => array(
                        'min' => null,
                        'max' => null,
                    ),
                    'cost' => array(
                        'min' => null,
                        'max' => null,
                    ),
                ),
                'info' => $ticker,
            );
        }
        return $result;
    }

    public function parse_balance($response) {
        $result = array( 'info' => $response );
        $balances = $this->omit($response, array(
            'errorCode',
            'result',
            'normalWallets',
        ));
        $currencyIds = is_array($balances) ? array_keys($balances) : array();
        for ($i = 0; $i < count($currencyIds); $i++) {
            $currencyId = $currencyIds[$i];
            $balance = $balances[$currencyId];
            $code = $this->safe_currency_code($currencyId);
            $account = $this->account();
            $account['free'] = $this->safe_string($balance, 'avail');
            $account['total'] = $this->safe_string($balance, 'balance');
            $result[$code] = $account;
        }
        return $this->safe_balance($result);
    }

    public function fetch_balance($params = array ()) {
        /**
         * query for balance and get the amount of funds available for trading or funds locked in orders
         * @param {dict} $params extra parameters specific to the coinone api endpoint
         * @return {dict} a ~@link https://docs.ccxt.com/en/latest/manual.html?#balance-structure balance structure~
         */
        yield $this->load_markets();
        $response = yield $this->privatePostAccountBalance ($params);
        return $this->parse_balance($response);
    }

    public function fetch_order_book($symbol, $limit = null, $params = array ()) {
        /**
         * fetches information on open orders with bid (buy) and ask (sell) prices, volumes and other data
         * @param {str} $symbol unified $symbol of the $market to fetch the order book for
         * @param {int|null} $limit the maximum amount of order book entries to return
         * @param {dict} $params extra parameters specific to the coinone api endpoint
         * @return {dict} A dictionary of {@link https://docs.ccxt.com/en/latest/manual.html#order-book-structure order book structures} indexed by $market symbols
         */
        yield $this->load_markets();
        $market = $this->market($symbol);
        $request = array(
            'currency' => $market['id'],
            'format' => 'json',
        );
        $response = yield $this->publicGetOrderbook (array_merge($request, $params));
        $timestamp = $this->safe_timestamp($response, 'timestamp');
        return $this->parse_order_book($response, $market['symbol'], $timestamp, 'bid', 'ask', 'price', 'qty');
    }

    public function fetch_tickers($symbols = null, $params = array ()) {
        /**
         * fetches price tickers for multiple markets, statistical calculations with the information calculated over the past 24 hours each $market
         * @param {[str]|null} $symbols unified $symbols of the markets to fetch the $ticker for, all $market tickers are returned if not assigned
         * @param {dict} $params extra parameters specific to the coinone api endpoint
         * @return {dict} an array of {@link https://docs.ccxt.com/en/latest/manual.html#$ticker-structure $ticker structures}
         */
        yield $this->load_markets();
        $request = array(
            'currency' => 'all',
            'format' => 'json',
        );
        $response = yield $this->publicGetTicker (array_merge($request, $params));
        $result = array();
        $ids = is_array($response) ? array_keys($response) : array();
        $timestamp = $this->safe_timestamp($response, 'timestamp');
        for ($i = 0; $i < count($ids); $i++) {
            $id = $ids[$i];
            $symbol = $id;
            $market = null;
            if (is_array($this->markets_by_id) && array_key_exists($id, $this->markets_by_id)) {
                $market = $this->markets_by_id[$id];
                $symbol = $market['symbol'];
                $ticker = $response[$id];
                $result[$symbol] = $this->parse_ticker($ticker, $market);
                $result[$symbol]['timestamp'] = $timestamp;
            }
        }
        return $this->filter_by_array($result, 'symbol', $symbols);
    }

    public function fetch_ticker($symbol, $params = array ()) {
        /**
         * fetches a price ticker, a statistical calculation with the information calculated over the past 24 hours for a specific $market
         * @param {str} $symbol unified $symbol of the $market to fetch the ticker for
         * @param {dict} $params extra parameters specific to the coinone api endpoint
         * @return {dict} a {@link https://docs.ccxt.com/en/latest/manual.html#ticker-structure ticker structure}
         */
        yield $this->load_markets();
        $market = $this->market($symbol);
        $request = array(
            'currency' => $market['id'],
            'format' => 'json',
        );
        $response = yield $this->publicGetTicker (array_merge($request, $params));
        return $this->parse_ticker($response, $market);
    }

    public function parse_ticker($ticker, $market = null) {
        //
        //     {
        //         "currency":"xec",
        //         "first":"0.1069",
        //         "low":"0.09",
        //         "high":"0.1069",
        //         "last":"0.0911",
        //         "volume":"4591217267.4974",
        //         "yesterday_first":"0.1128",
        //         "yesterday_low":"0.1035",
        //         "yesterday_high":"0.1167",
        //         "yesterday_last":"0.1069",
        //         "yesterday_volume":"4014832231.5102"
        //     }
        //
        $timestamp = $this->safe_timestamp($ticker, 'timestamp');
        $open = $this->safe_string($ticker, 'first');
        $last = $this->safe_string($ticker, 'last');
        $previousClose = $this->safe_string($ticker, 'yesterday_last');
        $symbol = $this->safe_symbol(null, $market);
        return $this->safe_ticker(array(
            'symbol' => $symbol,
            'timestamp' => $timestamp,
            'datetime' => $this->iso8601($timestamp),
            'high' => $this->safe_string($ticker, 'high'),
            'low' => $this->safe_string($ticker, 'low'),
            'bid' => null,
            'bidVolume' => null,
            'ask' => null,
            'askVolume' => null,
            'vwap' => null,
            'open' => $open,
            'close' => $last,
            'last' => $last,
            'previousClose' => $previousClose,
            'change' => null,
            'percentage' => null,
            'average' => null,
            'baseVolume' => $this->safe_string($ticker, 'volume'),
            'quoteVolume' => null,
            'info' => $ticker,
        ), $market);
    }

    public function parse_trade($trade, $market = null) {
        //
        // fetchTrades (public)
        //
        //     {
        //         "timestamp" => "1416893212",
        //         "price" => "420000.0",
        //         "qty" => "0.1",
        //         "is_ask" => "1"
        //     }
        //
        // fetchMyTrades (private)
        //
        //     {
        //         "timestamp" => "1416561032",
        //         "price" => "419000.0",
        //         "type" => "bid",
        //         "qty" => "0.001",
        //         "feeRate" => "-0.0015",
        //         "fee" => "-0.0000015",
        //         "orderId" => "E84A1AC2-8088-4FA0-B093-A3BCDB9B3C85"
        //     }
        //
        $timestamp = $this->safe_timestamp($trade, 'timestamp');
        $market = $this->safe_market(null, $market);
        $is_ask = $this->safe_string($trade, 'is_ask');
        $side = $this->safe_string($trade, 'type');
        if ($is_ask !== null) {
            if ($is_ask === '1') {
                $side = 'sell';
            } elseif ($is_ask === '0') {
                $side = 'buy';
            }
        } else {
            if ($side === 'ask') {
                $side = 'sell';
            } elseif ($side === 'bid') {
                $side = 'buy';
            }
        }
        $priceString = $this->safe_string($trade, 'price');
        $amountString = $this->safe_string($trade, 'qty');
        $orderId = $this->safe_string($trade, 'orderId');
        $feeCostString = $this->safe_string($trade, 'fee');
        $fee = null;
        if ($feeCostString !== null) {
            $feeCostString = Precise::string_abs($feeCostString);
            $feeRateString = $this->safe_string($trade, 'feeRate');
            $feeRateString = Precise::string_abs($feeRateString);
            $feeCurrencyCode = ($side === 'sell') ? $market['quote'] : $market['base'];
            $fee = array(
                'cost' => $feeCostString,
                'currency' => $feeCurrencyCode,
                'rate' => $feeRateString,
            );
        }
        return $this->safe_trade(array(
            'id' => $this->safe_string($trade, 'id'),
            'info' => $trade,
            'timestamp' => $timestamp,
            'datetime' => $this->iso8601($timestamp),
            'order' => $orderId,
            'symbol' => $market['symbol'],
            'type' => null,
            'side' => $side,
            'takerOrMaker' => null,
            'price' => $priceString,
            'amount' => $amountString,
            'cost' => null,
            'fee' => $fee,
        ), $market);
    }

    public function fetch_trades($symbol, $since = null, $limit = null, $params = array ()) {
        /**
         * get the list of most recent trades for a particular $symbol
         * @param {str} $symbol unified $symbol of the $market to fetch trades for
         * @param {int|null} $since timestamp in ms of the earliest trade to fetch
         * @param {int|null} $limit the maximum amount of trades to fetch
         * @param {dict} $params extra parameters specific to the coinone api endpoint
         * @return {[dict]} a list of ~@link https://docs.ccxt.com/en/latest/manual.html?#public-trades trade structures~
         */
        yield $this->load_markets();
        $market = $this->market($symbol);
        $request = array(
            'currency' => $market['id'],
            'format' => 'json',
        );
        $response = yield $this->publicGetTrades (array_merge($request, $params));
        //
        //     {
        //         "result" => "success",
        //         "errorCode" => "0",
        //         "timestamp" => "1416895635",
        //         "currency" => "btc",
        //         "completeOrders" => array(
        //             {
        //                 "timestamp" => "1416893212",
        //                 "price" => "420000.0",
        //                 "qty" => "0.1",
        //                 "is_ask" => "1"
        //             }
        //         )
        //     }
        //
        $completeOrders = $this->safe_value($response, 'completeOrders', array());
        return $this->parse_trades($completeOrders, $market, $since, $limit);
    }

    public function create_order($symbol, $type, $side, $amount, $price = null, $params = array ()) {
        /**
         * create a trade order
         * @param {str} $symbol unified $symbol of the $market to create an order in
         * @param {str} $type 'market' or 'limit'
         * @param {str} $side 'buy' or 'sell'
         * @param {float} $amount how much of currency you want to trade in units of base currency
         * @param {float|null} $price the $price at which the order is to be fullfilled, in units of the quote currency, ignored in $market orders
         * @param {dict} $params extra parameters specific to the coinone api endpoint
         * @return {dict} an {@link https://docs.ccxt.com/en/latest/manual.html#order-structure order structure}
         */
        if ($type !== 'limit') {
            throw new ExchangeError($this->id . ' createOrder() allows limit orders only');
        }
        yield $this->load_markets();
        $market = $this->market($symbol);
        $request = array(
            'price' => $price,
            'currency' => $market['id'],
            'qty' => $amount,
        );
        $method = 'privatePostOrder' . $this->capitalize($type) . $this->capitalize($side);
        $response = yield $this->$method (array_merge($request, $params));
        //
        //     {
        //         "result" => "success",
        //         "errorCode" => "0",
        //         "orderId" => "8a82c561-40b4-4cb3-9bc0-9ac9ffc1d63b"
        //     }
        //
        return $this->parse_order($response);
    }

    public function fetch_order($id, $symbol = null, $params = array ()) {
        /**
         * fetches information on an order made by the user
         * @param {str} $symbol unified $symbol of the $market the order was made in
         * @param {dict} $params extra parameters specific to the coinone api endpoint
         * @return {dict} An {@link https://docs.ccxt.com/en/latest/manual.html#order-structure order structure}
         */
        if ($symbol === null) {
            throw new ArgumentsRequired($this->id . ' fetchOrder() requires a $symbol argument');
        }
        yield $this->load_markets();
        $market = $this->market($symbol);
        $request = array(
            'order_id' => $id,
            'currency' => $market['id'],
        );
        $response = yield $this->privatePostOrderOrderInfo (array_merge($request, $params));
        //
        //     {
        //         "result" => "success",
        //         "errorCode" => "0",
        //         "status" => "live",
        //         "info" => {
        //             "orderId" => "32FF744B-D501-423A-8BA1-05BB6BE7814A",
        //             "currency" => "BTC",
        //             "type" => "bid",
        //             "price" => "2922000.0",
        //             "qty" => "115.4950",
        //             "remainQty" => "45.4950",
        //             "feeRate" => "0.0003",
        //             "fee" => "0",
        //             "timestamp" => "1499340941"
        //         }
        //     }
        //
        $info = $this->safe_value($response, 'info', array());
        $info['status'] = $this->safe_string($info, 'status');
        return $this->parse_order($info, $market);
    }

    public function parse_order_status($status) {
        $statuses = array(
            'live' => 'open',
            'partially_filled' => 'open',
            'filled' => 'closed',
        );
        return $this->safe_string($statuses, $status, $status);
    }

    public function parse_order($order, $market = null) {
        //
        // createOrder
        //
        //     {
        //         "result" => "success",
        //         "errorCode" => "0",
        //         "orderId" => "8a82c561-40b4-4cb3-9bc0-9ac9ffc1d63b"
        //     }
        //
        // fetchOrder
        //
        //     {
        //         "status" => "live", // injected in fetchOrder
        //         "orderId" => "32FF744B-D501-423A-8BA1-05BB6BE7814A",
        //         "currency" => "BTC",
        //         "type" => "bid",
        //         "price" => "2922000.0",
        //         "qty" => "115.4950",
        //         "remainQty" => "45.4950",
        //         "feeRate" => "0.0003",
        //         "fee" => "0",
        //         "timestamp" => "1499340941"
        //     }
        //
        // fetchOpenOrders
        //
        //     {
        //         "index" => "0",
        //         "orderId" => "68665943-1eb5-4e4b-9d76-845fc54f5489",
        //         "timestamp" => "1449037367",
        //         "price" => "444000.0",
        //         "qty" => "0.3456",
        //         "type" => "ask",
        //         "feeRate" => "-0.0015"
        //     }
        //
        $id = $this->safe_string($order, 'orderId');
        $priceString = $this->safe_string($order, 'price');
        $timestamp = $this->safe_timestamp($order, 'timestamp');
        $side = $this->safe_string($order, 'type');
        if ($side === 'ask') {
            $side = 'sell';
        } elseif ($side === 'bid') {
            $side = 'buy';
        }
        $remainingString = $this->safe_string($order, 'remainQty');
        $amountString = $this->safe_string($order, 'qty');
        $status = $this->safe_string($order, 'status');
        // https://github.com/ccxt/ccxt/pull/7067
        if ($status === 'live') {
            if (($remainingString !== null) && ($amountString !== null)) {
                $isLessThan = Precise::string_lt($remainingString, $amountString);
                if ($isLessThan) {
                    $status = 'canceled';
                }
            }
        }
        $status = $this->parse_order_status($status);
        $symbol = null;
        $base = null;
        $quote = null;
        $marketId = $this->safe_string_lower($order, 'currency');
        if ($marketId !== null) {
            if (is_array($this->markets_by_id) && array_key_exists($marketId, $this->markets_by_id)) {
                $market = $this->markets_by_id[$marketId];
            } else {
                $base = $this->safe_currency_code($marketId);
                $quote = 'KRW';
                $symbol = $base . '/' . $quote;
            }
        }
        if (($symbol === null) && ($market !== null)) {
            $symbol = $market['symbol'];
            $base = $market['base'];
            $quote = $market['quote'];
        }
        $fee = null;
        $feeCostString = $this->safe_string($order, 'fee');
        if ($feeCostString !== null) {
            $feeCurrencyCode = ($side === 'sell') ? $quote : $base;
            $fee = array(
                'cost' => $feeCostString,
                'rate' => $this->safe_string($order, 'feeRate'),
                'currency' => $feeCurrencyCode,
            );
        }
        return $this->safe_order(array(
            'info' => $order,
            'id' => $id,
            'clientOrderId' => null,
            'timestamp' => $timestamp,
            'datetime' => $this->iso8601($timestamp),
            'lastTradeTimestamp' => null,
            'symbol' => $symbol,
            'type' => 'limit',
            'timeInForce' => null,
            'postOnly' => null,
            'side' => $side,
            'price' => $priceString,
            'stopPrice' => null,
            'cost' => null,
            'average' => null,
            'amount' => $amountString,
            'filled' => null,
            'remaining' => $remainingString,
            'status' => $status,
            'fee' => $fee,
            'trades' => null,
        ), $market);
    }

    public function fetch_open_orders($symbol = null, $since = null, $limit = null, $params = array ()) {
        /**
         * fetch all unfilled currently open orders
         * @param {str} $symbol unified $market $symbol
         * @param {int|null} $since the earliest time in ms to fetch open orders for
         * @param {int|null} $limit the maximum number of  open orders structures to retrieve
         * @param {dict} $params extra parameters specific to the coinone api endpoint
         * @return {[dict]} a list of {@link https://docs.ccxt.com/en/latest/manual.html#order-structure order structures}
         */
        // The returned amount might not be same as the ordered amount. If an order is partially filled, the returned amount means the remaining amount.
        // For the same reason, the returned amount and remaining are always same, and the returned filled and cost are always zero.
        if ($symbol === null) {
            throw new ExchangeError($this->id . ' fetchOpenOrders() allows fetching closed orders with a specific symbol');
        }
        yield $this->load_markets();
        $market = $this->market($symbol);
        $request = array(
            'currency' => $market['id'],
        );
        $response = yield $this->privatePostOrderLimitOrders (array_merge($request, $params));
        //
        //     {
        //         "result" => "success",
        //         "errorCode" => "0",
        //         "limitOrders" => array(
        //             {
        //                 "index" => "0",
        //                 "orderId" => "68665943-1eb5-4e4b-9d76-845fc54f5489",
        //                 "timestamp" => "1449037367",
        //                 "price" => "444000.0",
        //                 "qty" => "0.3456",
        //                 "type" => "ask",
        //                 "feeRate" => "-0.0015"
        //             }
        //         )
        //     }
        //
        $limitOrders = $this->safe_value($response, 'limitOrders', array());
        return $this->parse_orders($limitOrders, $market, $since, $limit);
    }

    public function fetch_my_trades($symbol = null, $since = null, $limit = null, $params = array ()) {
        /**
         * fetch all trades made by the user
         * @param {str} $symbol unified $market $symbol
         * @param {int|null} $since the earliest time in ms to fetch trades for
         * @param {int|null} $limit the maximum number of trades structures to retrieve
         * @param {dict} $params extra parameters specific to the coinone api endpoint
         * @return {[dict]} a list of {@link https://docs.ccxt.com/en/latest/manual.html#trade-structure trade structures}
         */
        if ($symbol === null) {
            throw new ArgumentsRequired($this->id . ' fetchMyTrades() requires a $symbol argument');
        }
        yield $this->load_markets();
        $market = $this->market($symbol);
        $request = array(
            'currency' => $market['id'],
        );
        $response = yield $this->privatePostOrderCompleteOrders (array_merge($request, $params));
        //
        // despite the name of the endpoint it returns trades which may have a duplicate orderId
        // https://github.com/ccxt/ccxt/pull/7067
        //
        //     {
        //         "result" => "success",
        //         "errorCode" => "0",
        //         "completeOrders" => array(
        //             {
        //                 "timestamp" => "1416561032",
        //                 "price" => "419000.0",
        //                 "type" => "bid",
        //                 "qty" => "0.001",
        //                 "feeRate" => "-0.0015",
        //                 "fee" => "-0.0000015",
        //                 "orderId" => "E84A1AC2-8088-4FA0-B093-A3BCDB9B3C85"
        //             }
        //         )
        //     }
        //
        $completeOrders = $this->safe_value($response, 'completeOrders', array());
        return $this->parse_trades($completeOrders, $market, $since, $limit);
    }

    public function cancel_order($id, $symbol = null, $params = array ()) {
        /**
         * cancels an open order
         * @param {str} $id order $id
         * @param {str} $symbol unified $symbol of the market the order was made in
         * @param {dict} $params extra parameters specific to the coinone api endpoint
         * @return {dict} An {@link https://docs.ccxt.com/en/latest/manual.html#order-structure order structure}
         */
        if ($symbol === null) {
            // eslint-disable-next-line quotes
            throw new ArgumentsRequired($this->id . " cancelOrder() requires a $symbol argument. To cancel the order, pass a $symbol argument and array('price' => 12345, 'qty' => 1.2345, 'is_ask' => 0) in the $params argument of cancelOrder.");
        }
        $price = $this->safe_number($params, 'price');
        $qty = $this->safe_number($params, 'qty');
        $isAsk = $this->safe_integer($params, 'is_ask');
        if (($price === null) || ($qty === null) || ($isAsk === null)) {
            // eslint-disable-next-line quotes
            throw new ArgumentsRequired($this->id . " cancelOrder() requires array('price' => 12345, 'qty' => 1.2345, 'is_ask' => 0) in the $params argument.");
        }
        yield $this->load_markets();
        $request = array(
            'order_id' => $id,
            'price' => $price,
            'qty' => $qty,
            'is_ask' => $isAsk,
            'currency' => $this->market_id($symbol),
        );
        $response = yield $this->privatePostOrderCancel (array_merge($request, $params));
        //
        //     {
        //         "result" => "success",
        //         "errorCode" => "0"
        //     }
        //
        return $response;
    }

    public function fetch_deposit_addresses($codes = null, $params = array ()) {
        /**
         * fetch deposit addresses for multiple currencies and chain types
         * @param {[str]|null} $codes list of unified currency $codes, default is null
         * @param {dict} $params extra parameters specific to the coinone api endpoint
         * @return {dict} a list of {@link https://docs.ccxt.com/en/latest/manual.html#$address-structure $address structures}
         */
        yield $this->load_markets();
        $response = yield $this->privatePostAccountDepositAddress ($params);
        //
        //     {
        //         $result => 'success',
        //         errorCode => '0',
        //         $walletAddress => {
        //             matic => null,
        //             btc => "mnobqu4i6qMCJWDpf5UimRmr8JCvZ8FLcN",
        //             xrp => null,
        //             xrp_tag => '-1',
        //             kava => null,
        //             kava_memo => null,
        //         }
        //     }
        //
        $walletAddress = $this->safe_value($response, 'walletAddress', array());
        $keys = is_array($walletAddress) ? array_keys($walletAddress) : array();
        $result = array();
        for ($i = 0; $i < count($keys); $i++) {
            $key = $keys[$i];
            $value = $walletAddress[$key];
            if ((!$value) || ($value === '-1')) {
                continue;
            }
            $parts = explode('_', $key);
            $currencyId = $this->safe_value($parts, 0);
            $secondPart = $this->safe_value($parts, 1);
            $code = $this->safe_currency_code($currencyId);
            $depositAddress = $this->safe_value($result, $code);
            if ($depositAddress === null) {
                $depositAddress = array(
                    'currency' => $code,
                    'address' => null,
                    'tag' => null,
                    'info' => $value,
                );
            }
            $address = $this->safe_string($depositAddress, 'address', $value);
            $this->check_address($address);
            $depositAddress['address'] = $address;
            $depositAddress['info'] = $address;
            if (($secondPart === 'tag' || $secondPart === 'memo')) {
                $depositAddress['tag'] = $value;
                $depositAddress['info'] = array( $address, $value );
            }
            $result[$code] = $depositAddress;
        }
        return $result;
    }

    public function sign($path, $api = 'public', $method = 'GET', $params = array (), $headers = null, $body = null) {
        $request = $this->implode_params($path, $params);
        $query = $this->omit($params, $this->extract_params($path));
        $url = $this->urls['api'] . '/';
        if ($api === 'public') {
            $url .= $request;
            if ($query) {
                $url .= '?' . $this->urlencode($query);
            }
        } else {
            $this->check_required_credentials();
            $url .= $this->version . '/' . $request;
            $nonce = (string) $this->nonce();
            $json = $this->json(array_merge(array(
                'access_token' => $this->apiKey,
                'nonce' => $nonce,
            ), $params));
            $payload = base64_encode($json);
            $body = $this->decode($payload);
            $secret = strtoupper($this->secret);
            $signature = $this->hmac($payload, $this->encode($secret), 'sha512');
            $headers = array(
                'Content-Type' => 'application/json',
                'X-COINONE-PAYLOAD' => $payload,
                'X-COINONE-SIGNATURE' => $signature,
            );
        }
        return array( 'url' => $url, 'method' => $method, 'body' => $body, 'headers' => $headers );
    }

    public function handle_errors($code, $reason, $url, $method, $headers, $body, $response, $requestHeaders, $requestBody) {
        if ($response === null) {
            return;
        }
        if (is_array($response) && array_key_exists('result', $response)) {
            $result = $response['result'];
            if ($result !== 'success') {
                //
                //    array(  "errorCode" => "405",  "status" => "maintenance",  "result" => "error")
                //
                $errorCode = $this->safe_string($response, 'errorCode');
                $feedback = $this->id . ' ' . $body;
                $this->throw_exactly_matched_exception($this->exceptions, $errorCode, $feedback);
                throw new ExchangeError($feedback);
            }
        } else {
            throw new ExchangeError($this->id . ' ' . $body);
        }
    }
}
