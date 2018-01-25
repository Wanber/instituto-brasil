import { EnrolmentproPage } from './app.po';

describe('enrolmentpro App', () => {
  let page: EnrolmentproPage;

  beforeEach(() => {
    page = new EnrolmentproPage();
  });

  it('should display message saying app works', () => {
    page.navigateTo();
    expect(page.getParagraphText()).toEqual('app works!');
  });
});
