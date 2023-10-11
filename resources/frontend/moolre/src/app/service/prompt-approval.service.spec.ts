import { TestBed } from '@angular/core/testing';

import { PromptApprovalService } from './prompt-approval.service';

describe('PromptApprovalService', () => {
  let service: PromptApprovalService;

  beforeEach(() => {
    TestBed.configureTestingModule({});
    service = TestBed.inject(PromptApprovalService);
  });

  it('should be created', () => {
    expect(service).toBeTruthy();
  });
});
