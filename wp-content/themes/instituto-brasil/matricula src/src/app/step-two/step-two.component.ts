import { Component, OnInit } from '@angular/core';
import {EnrolmentService} from '../enrolment.service';
import {EnrolmentPostService} from '../enrolment-post.service';
import {CepService} from '../cep.service';
import {Router} from '@angular/router';

@Component({
  selector: 'app-step-two',
  templateUrl: './step-two.component.html',
  styleUrls: ['./step-two.component.css']
})
export class StepTwoComponent implements OnInit {

  public datamask = [/\d/, /\d/, '/', /\d/, /\d/, '/', /\d/, /\d/, /\d/, /\d/];
  public cepmask = [/\d/, /\d/, /\d/, /\d/, /\d/, '-', /\d/, /\d/, /\d/];
  public enrolment: any;
  public city: any;
  public state: any;
  public graduation: any;
  public cityn: any;
  public staten: any;
  public contract: any;
  public enrolmentplane: any;
  public enrolmentdate: any;
  public pagamentplane: any;
  public monthpagament: any;
  public materialplane: any;
  public message: any = false;
  public colacao = false;
  public resultcolacao: any;

  constructor(private enrolmentService: EnrolmentService, private enrolmentPostService: EnrolmentPostService, private cepService: CepService, private router: Router) { }

  ngOnInit() {
    this.enrolment = this.enrolmentPostService.enrolment;
    this.verifier();
    this.getState();
    this.getCity();
    this.getGraduation();
    this.getStateN();
    this.getCityN();
    this.getContract();
    this.getEnrolmentPlane();
    this.getEnrolmentDate();
    this.getPagamentPlane();
    this.getMonthPagament();
    this.getMaterialPlane();

    if (this.enrolmentPostService.enrolment.dtcolacaodegrau) {
      this.verifyDtColacao();
    }
  }

  verifier(){
    if (!this.enrolmentPostService.enrolment.stepone) {
      this.router.navigateByUrl('/');
    }
  }

  getState(){
    this.enrolmentService.getBuilder('state')
      .list()
      .then((res) => {
        this.state = res || {};
      });
  }

  getCity(){
    const s = this.enrolmentPostService.enrolment.cdestado;
    if ( s != null) {
      this.enrolmentService.getBuilder('city/' + s)
        .list()
        .then((res) => {
          this.city = res || {};
        });
      }
  }

  getGraduation(){
    this.enrolmentService.getBuilder('graduation')
      .list()
      .then((res) => {
        this.graduation = res || {};
      });
  }

  getStateN(){
    this.enrolmentService.getBuilder('state')
      .list()
      .then((res) => {
        this.staten = res || {};
      });
  }

  getCityN(){
    const s = this.enrolmentPostService.enrolment.cdestadonaturalidade;
    if ( s != null) {
      this.enrolmentService.getBuilder('city/' + s)
        .list()
        .then((res) => {
          this.cityn = res || {};
        });
    }
  }

  getContract(){
    this.enrolmentService.getBuilder('contract')
      .list()
      .then((res) => {
        this.contract = res.dsccontrato || {};
      });
  }

  getEnrolmentPlane(){
    const c = this.enrolmentPostService.enrolment.cdcurso;
    if (c != null) {
      this.enrolmentService.getBuilder('enrolment_plane/' + c)
        .list()
        .then((res) => {
          this.enrolmentplane = res || {};
        });
    }
  }

  getEnrolmentDate(){
    this.enrolmentService.getBuilder('enrolment_date/15')
      .list()
      .then((res) => {
        this.enrolmentdate = res || {};
      });
  }

  getPagamentPlane(){
    const c = this.enrolmentPostService.enrolment.cdcurso;
    if (c != null) {
      this.enrolmentService.getBuilder('pagamment_plane/' + c)
        .list()
        .then((res) => {
          this.pagamentplane = res || {};
        });
    }
  }

  getMonthPagament(){
    this.enrolmentService.getBuilder('pagamment_month/2')
      .list()
      .then((res) => {
        this.monthpagament = res || {};
      });
  }

  getMaterialPlane(){
    const c = this.enrolmentPostService.enrolment.cdcurso;
    if (c != null) {
      this.enrolmentService.getBuilder('material_plane/' + c)
        .list()
        .then((res) => {
          this.materialplane = res || {};
        });
    }
  }

  getAddress(c){
    const cep = c.replace('-', '');
    this.cepService.getCep(cep)
      .list()
      .then((res) => {
        this.enrolmentPostService.setAddress(res);
        this.getCityState(res.localidade);
      });
  }

  getCityState(n){
    this.enrolmentService.getBuilder('codecitystate/' + n)
      .list()
      .then((res) => {
        this.enrolmentPostService.enrolment.cdestado = res.cdestado;
        this.getCity();
        this.enrolmentPostService.enrolment.cdcidade = res.cdcidade;
      });
  }

  submitForm2(form){

    if (!form.valid) {
      this.message = 'Todos os campos devem ser preenchidos.';

    } else {

      const res = this.resultcolacao;

      if (!res.termo_ciencia && !res.colou_grau) {
        this.colacao = true;

      }else if (!res.termo_ciencia && res.colou_grau) {
        this.enrolmentPostService.enrolment.termociencia = 'N';
        this.router.navigateByUrl('/step-three');

      }else if (res.termo_ciencia && !res.colou_grau) {
        this.enrolmentPostService.enrolment.termociencia = 'S';
        this.router.navigateByUrl('/step-three');
      }

    }
  }

  verifyDtColacao() {

    const  d =  this.replaceDate(this.enrolmentPostService.enrolment.dtcolacaodegrau),
        tc = this.enrolmentPostService.enrolment.cdtpcurso;

    this.enrolmentService.getBuilder('verifydtcolacao/' + d + '/' + tc)
      .list()
      .then((res) => {

        this.resultcolacao = res;

        if (!res.termo_ciencia && !res.colou_grau) {
          this.colacao = true;

        }else if (!res.termo_ciencia && res.colou_grau) {
          this.enrolmentPostService.enrolment.termociencia = 'N';
          this.colacao = false;

        }else if (res.termo_ciencia && !res.colou_grau) {
          this.enrolmentPostService.enrolment.termociencia = 'S';
          this.colacao = false;
        }

      });
  }

  replaceDate(a) {
   const data = a.replace('/', '-');
   return data.replace('/', '-');
  }

}
