import { TestBed, inject } from '@angular/core/testing';

import { EnrolmentPostService } from './enrolment-post.service';

describe('EnrolmentPostService', () => {
  beforeEach(() => {
    TestBed.configureTestingModule({
      providers: [EnrolmentPostService]
    });
  });

  it('should ...', inject([EnrolmentPostService], (service: EnrolmentPostService) => {
    expect(service).toBeTruthy();
  }));
});
