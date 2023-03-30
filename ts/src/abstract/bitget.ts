// -------------------------------------------------------------------------------

// PLEASE DO NOT EDIT THIS FILE, IT IS GENERATED AND WILL BE OVERWRITTEN:
// https://github.com/ccxt/ccxt/blob/master/CONTRIBUTING.md#how-to-contribute-code

// -------------------------------------------------------------------------------

import { implicitReturnType } from '../base/types.js';
import { Exchange as _Exchange } from '../base/Exchange.js';

interface Exchange {
     publicSpotGetPublicTime (params?: {}): Promise<implicitReturnType>;
     publicSpotGetPublicCurrencies (params?: {}): Promise<implicitReturnType>;
     publicSpotGetPublicProducts (params?: {}): Promise<implicitReturnType>;
     publicSpotGetPublicProduct (params?: {}): Promise<implicitReturnType>;
     publicSpotGetMarketTicker (params?: {}): Promise<implicitReturnType>;
     publicSpotGetMarketTickers (params?: {}): Promise<implicitReturnType>;
     publicSpotGetMarketFills (params?: {}): Promise<implicitReturnType>;
     publicSpotGetMarketCandles (params?: {}): Promise<implicitReturnType>;
     publicSpotGetMarketDepth (params?: {}): Promise<implicitReturnType>;
     publicSpotGetMarketSpotVipLevel (params?: {}): Promise<implicitReturnType>;
     publicMixGetMarketContracts (params?: {}): Promise<implicitReturnType>;
     publicMixGetMarketDepth (params?: {}): Promise<implicitReturnType>;
     publicMixGetMarketTicker (params?: {}): Promise<implicitReturnType>;
     publicMixGetMarketTickers (params?: {}): Promise<implicitReturnType>;
     publicMixGetMarketFills (params?: {}): Promise<implicitReturnType>;
     publicMixGetMarketCandles (params?: {}): Promise<implicitReturnType>;
     publicMixGetMarketIndex (params?: {}): Promise<implicitReturnType>;
     publicMixGetMarketFundingTime (params?: {}): Promise<implicitReturnType>;
     publicMixGetMarketHistoryFundRate (params?: {}): Promise<implicitReturnType>;
     publicMixGetMarketCurrentFundRate (params?: {}): Promise<implicitReturnType>;
     publicMixGetMarketOpenInterest (params?: {}): Promise<implicitReturnType>;
     publicMixGetMarketMarkPrice (params?: {}): Promise<implicitReturnType>;
     publicMixGetMarketSymbolLeverage (params?: {}): Promise<implicitReturnType>;
     publicMixGetMarketContractVipLevel (params?: {}): Promise<implicitReturnType>;
     privateSpotGetAccountGetInfo (params?: {}): Promise<implicitReturnType>;
     privateSpotGetAccountAssets (params?: {}): Promise<implicitReturnType>;
     privateSpotGetAccountTransferRecords (params?: {}): Promise<implicitReturnType>;
     privateSpotGetWalletDepositAddress (params?: {}): Promise<implicitReturnType>;
     privateSpotGetWalletWithdrawalInner (params?: {}): Promise<implicitReturnType>;
     privateSpotGetWalletWithdrawalList (params?: {}): Promise<implicitReturnType>;
     privateSpotGetWalletDepositList (params?: {}): Promise<implicitReturnType>;
     privateSpotPostAccountBills (params?: {}): Promise<implicitReturnType>;
     privateSpotPostAccountSubAccountSpotAssets (params?: {}): Promise<implicitReturnType>;
     privateSpotPostTradeOrders (params?: {}): Promise<implicitReturnType>;
     privateSpotPostTradeBatchOrders (params?: {}): Promise<implicitReturnType>;
     privateSpotPostTradeCancelOrder (params?: {}): Promise<implicitReturnType>;
     privateSpotPostTradeCancelBatchOrders (params?: {}): Promise<implicitReturnType>;
     privateSpotPostTradeCancelBatchOrdersV2 (params?: {}): Promise<implicitReturnType>;
     privateSpotPostTradeOrderInfo (params?: {}): Promise<implicitReturnType>;
     privateSpotPostTradeOpenOrders (params?: {}): Promise<implicitReturnType>;
     privateSpotPostTradeHistory (params?: {}): Promise<implicitReturnType>;
     privateSpotPostTradeFills (params?: {}): Promise<implicitReturnType>;
     privateSpotPostWalletTransfer (params?: {}): Promise<implicitReturnType>;
     privateSpotPostWalletWithdrawal (params?: {}): Promise<implicitReturnType>;
     privateSpotPostWalletSubTransfer (params?: {}): Promise<implicitReturnType>;
     privateSpotPostPlanPlacePlan (params?: {}): Promise<implicitReturnType>;
     privateSpotPostPlanModifyPlan (params?: {}): Promise<implicitReturnType>;
     privateSpotPostPlanCancelPlan (params?: {}): Promise<implicitReturnType>;
     privateSpotPostPlanCurrentPlan (params?: {}): Promise<implicitReturnType>;
     privateSpotPostPlanHistoryPlan (params?: {}): Promise<implicitReturnType>;
     privateMixGetAccountAccount (params?: {}): Promise<implicitReturnType>;
     privateMixGetAccountAccounts (params?: {}): Promise<implicitReturnType>;
     privateMixGetAccountAccountBill (params?: {}): Promise<implicitReturnType>;
     privateMixGetAccountAccountBusinessBill (params?: {}): Promise<implicitReturnType>;
     privateMixGetAccountOpenCount (params?: {}): Promise<implicitReturnType>;
     privateMixGetOrderCurrent (params?: {}): Promise<implicitReturnType>;
     privateMixGetOrderHistory (params?: {}): Promise<implicitReturnType>;
     privateMixGetOrderDetail (params?: {}): Promise<implicitReturnType>;
     privateMixGetOrderFills (params?: {}): Promise<implicitReturnType>;
     privateMixGetOrderHistoryProductType (params?: {}): Promise<implicitReturnType>;
     privateMixGetOrderAllFills (params?: {}): Promise<implicitReturnType>;
     privateMixGetPlanCurrentPlan (params?: {}): Promise<implicitReturnType>;
     privateMixGetPlanHistoryPlan (params?: {}): Promise<implicitReturnType>;
     privateMixGetPositionSinglePosition (params?: {}): Promise<implicitReturnType>;
     privateMixGetPositionAllPosition (params?: {}): Promise<implicitReturnType>;
     privateMixGetTraceCurrentTrack (params?: {}): Promise<implicitReturnType>;
     privateMixGetTraceFollowerOrder (params?: {}): Promise<implicitReturnType>;
     privateMixGetTraceHistoryTrack (params?: {}): Promise<implicitReturnType>;
     privateMixGetTraceSummary (params?: {}): Promise<implicitReturnType>;
     privateMixGetTraceProfitSettleTokenIdGroup (params?: {}): Promise<implicitReturnType>;
     privateMixGetTraceProfitDateGroupList (params?: {}): Promise<implicitReturnType>;
     privateMixGetTradeProfitDateList (params?: {}): Promise<implicitReturnType>;
     privateMixGetTraceWaitProfitDateList (params?: {}): Promise<implicitReturnType>;
     privateMixGetTraceTraderSymbols (params?: {}): Promise<implicitReturnType>;
     privateMixGetOrderMarginCoinCurrent (params?: {}): Promise<implicitReturnType>;
     privateMixPostAccountSetLeverage (params?: {}): Promise<implicitReturnType>;
     privateMixPostAccountSetMargin (params?: {}): Promise<implicitReturnType>;
     privateMixPostAccountSetMarginMode (params?: {}): Promise<implicitReturnType>;
     privateMixPostAccountSetPositionMode (params?: {}): Promise<implicitReturnType>;
     privateMixPostOrderPlaceOrder (params?: {}): Promise<implicitReturnType>;
     privateMixPostOrderBatchOrders (params?: {}): Promise<implicitReturnType>;
     privateMixPostOrderCancelOrder (params?: {}): Promise<implicitReturnType>;
     privateMixPostOrderCancelAllOrders (params?: {}): Promise<implicitReturnType>;
     privateMixPostOrderCancelBatchOrders (params?: {}): Promise<implicitReturnType>;
     privateMixPostPlanPlacePlan (params?: {}): Promise<implicitReturnType>;
     privateMixPostPlanModifyPlan (params?: {}): Promise<implicitReturnType>;
     privateMixPostPlanModifyPlanPreset (params?: {}): Promise<implicitReturnType>;
     privateMixPostPlanPlaceTPSL (params?: {}): Promise<implicitReturnType>;
     privateMixPostPlanPlaceTrailStop (params?: {}): Promise<implicitReturnType>;
     privateMixPostPlanPlacePositionsTPSL (params?: {}): Promise<implicitReturnType>;
     privateMixPostPlanModifyTPSLPlan (params?: {}): Promise<implicitReturnType>;
     privateMixPostPlanCancelPlan (params?: {}): Promise<implicitReturnType>;
     privateMixPostPlanCancelAllPlan (params?: {}): Promise<implicitReturnType>;
     privateMixPostTraceCloseTrackOrder (params?: {}): Promise<implicitReturnType>;
     privateMixPostTraceSetUpCopySymbols (params?: {}): Promise<implicitReturnType>;
}
abstract class Exchange extends _Exchange {}

export default Exchange