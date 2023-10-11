import { HttpClient } from '@angular/common/http';
import { Injectable } from '@angular/core';
import { AppSettings } from './app-settings';

@Injectable({
  providedIn: 'root'
})
export class PromptApprovalService {
  baseURL: string = AppSettings.hostURL;

  constructor(private httpClient: HttpClient) { }

  promptApproval(inputData: object){
    return this.httpClient.post('http://127.0.0.1:8000/api/v1/payments/checkout', inputData);
  }
}
