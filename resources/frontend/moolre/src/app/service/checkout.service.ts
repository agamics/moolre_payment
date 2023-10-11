import { HttpClient } from '@angular/common/http';
import { Injectable } from '@angular/core';
import { AppSettings } from './app-settings';

@Injectable({
  providedIn: 'root'
})
export class CheckoutService {
  baseURL: string = AppSettings.hostURL;

  constructor(private httpClient: HttpClient) { }

  verifyMobile(inputData: object){
    return this.httpClient.post(this.baseURL + '/api/v1/payments/checkout', inputData);
  }
}
