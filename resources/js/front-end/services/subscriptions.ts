import { ModelData, ListData } from "../types/services";
import { ISubscription } from "../types/subcription";
import { getRequest, patchRequest, postRequest } from "./utils";

export const getAllSubscriptions = () => getRequest<ReadonlyArray<ISubscription>>(`/subscriptions`);

export const getSubscription = (id: number) =>
    getRequest<ISubscription>(`/subscriptions/${id}`);

export const updateSubscription = (id: number, data: any) =>
    patchRequest<ISubscription>(`/subscriptions/${id}`, data);

export const updateSubscriptionStatus = (id: number, data: any) =>
    patchRequest<ISubscription>(`/subscriptions/${id}`, data);

export const createSubscription = (data: any) =>
    postRequest<ISubscription>(`/subscriptions`, data);

