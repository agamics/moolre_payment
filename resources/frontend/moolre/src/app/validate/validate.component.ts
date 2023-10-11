import { Component } from '@angular/core';

import { CheckoutService } from '../service/checkout.service';
import { VerifyOptService } from '../service/verify-opt.service';
import { PromptApprovalService } from '../service/prompt-approval.service';

@Component({
  selector: 'app-validate',
  templateUrl: './validate.component.html',
  styleUrls: ['./validate.component.css']
})

export class ValidateComponent {
  constructor(private checkoutService: CheckoutService,
    private verifyOptService: VerifyOptService,
    private promptApprovalService: PromptApprovalService
  ) {}

  logo: any = './assets/brand/moolre-logo.svg';
  stage: number = 1;
  myNumber!: string;
  otpNumber!: string;
  myProvider!: string;
  myOtp!: string;
  myTransId: string = 'xxx';
  errors: any = [];
  response: any = [];

  verifyMobile() {
    var inputData = {
      myNumber: this.myNumber,
      myProvider: this.myProvider
    }

    this.checkoutService.verifyMobile(inputData).subscribe({
      next: (resp) => {
        let resSTR = JSON.stringify(resp);
        let resJSON = JSON.parse(resSTR);
        console.log(resJSON);
        if(resSTR = 'success'){
          this.myTransId = resJSON.trans_id
          this.otpNumber = resJSON.mobile
          this.stage = 2;
        }
      },
      error: (erro) => {
        this.errors = erro.error.errors
        console.log(erro, 'errors')
      }
    })
  }

  verifyOtp() {
    var inputData = {
      myOtp: this.myOtp,
      myTransId: this.myTransId,
      otpNumber: this.otpNumber
    }

    this.verifyOptService.verifyOtp(inputData).subscribe({
      next: (resp) => {
        let resSTR = JSON.stringify(resp);
        let resJSON = JSON.parse(resSTR);
        console.log(resJSON);
        if(resSTR = 'success'){
          this.stage = 3;
        }
      },
      error: (erro) => {
        this.errors = erro.error.errors
        console.log(erro, 'errors')
      }
    })
  }

  promptApproval() {
    var inputData = {
      myTransId: this.myTransId,
      otpNumber: this.otpNumber
    }

    this.promptApprovalService.promptApproval(inputData).subscribe({
      next: (resp) => {
        let resSTR = JSON.stringify(resp);
        let resJSON = JSON.parse(resSTR);
        console.log(resJSON);
        if(resSTR = 'success'){
          this.stage = 3;
        }
      },
      error: (erro) => {
        this.errors = erro.error.errors
        console.log(erro, 'errors')
      }
    })
  }
}
