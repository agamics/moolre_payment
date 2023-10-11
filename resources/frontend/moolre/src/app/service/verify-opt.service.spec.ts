import { TestBed } from '@angular/core/testing';

import { VerifyOptService } from './verify-opt.service';

describe('VerifyOptService', () => {
  let service: VerifyOptService;

  beforeEach(() => {
    TestBed.configureTestingModule({});
    service = TestBed.inject(VerifyOptService);
  });

  it('should be created', () => {
    expect(service).toBeTruthy();
  });
});
