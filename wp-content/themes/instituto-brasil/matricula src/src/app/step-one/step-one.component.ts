import { Component, OnInit } from '@angular/core';
import {EnrolmentService} from '../enrolment.service';
import {EnrolmentPostService} from '../enrolment-post.service';
import {Router} from '@angular/router';


@Component({
  selector: 'app-step-one',
  templateUrl: './step-one.component.html',
  styleUrls: ['./step-one.component.css']
})

export class StepOneComponent implements OnInit {

  public courseType: any = [];
  public courseArea: any;
  public course: any;
  public midias: any;
  public enrolment: any;
  public cpfmask = [/\d/, /\d/, /\d/, '.', /\d/, /\d/, /\d/, '.', /\d/, /\d/, /\d/, '-', /\d/, /\d/];
  public phonefix = ['(', /[1-9]/, /\d/, ')', ' ', /\d/, /\d/, /\d/, /\d/, '-', /\d/, /\d/, /\d/, /\d/];
  public phonecel = ['(', /[1-9]/, /\d/, ')', ' ', /\d/, /\d/, /\d/, /\d/, /\d/, '-', /\d/, /\d/, /\d/, /\d/];
  public message: any = false;
  public incompleta = false;
  public discipline: any;

  constructor(private enrolmentService: EnrolmentService, private enrolmentPostService: EnrolmentPostService, private router: Router) { }

  ngOnInit() {
    this.listCourseType();
    this.listCourseArea();
    this.listMidias();
    this.enrolment = this.enrolmentPostService.enrolment;
    this.listCourse();

    if (this.enrolmentPostService.enrolment.cdcurso != null) {
      this.listDiscipline(this.enrolmentPostService.enrolment.cdcurso);
    }
  }

  listCourseType(){
    this.enrolmentService.getBuilder('course_type')
      .list()
      .then((res) => {
          // this.courseType = res || {};

          // TEMPORARIO - EXCLUIR SEGUNDA LICENCIATURA E OBTENCAO D ENOV TITUTOLO

          for (let i = 0; i < res.length; i++) {
              if (res[i].cdtpcurso != '6' && res[i].cdtpcurso != '7') {
                  this.courseType.push(res[i]);
              }
          }
          // FIM
      });
  }

  listCourseArea(){
    this.enrolmentService.getBuilder('course_area')
      .list()
      .then((res) => {
        this.courseArea = res || {};
      });
  }

  listCourse(){

    const t = this.enrolmentPostService.enrolment.cdtpcurso,
        a = this.enrolmentPostService.enrolment.cdcurso_area;

    if ( t != '' &&  a != '') {
      this.enrolmentService.getBuilder('course/' + t + '/' + a)
        .list()
        .then((res) => {
          this.course = res || {};
        });
    }
  }

  listDiscipline(id) {
    this.enrolmentService.getBuilder('discipline/' + id)
      .list()
      .then((res) => {
        this.discipline = res || {};
      });
  }

  listMidias(){
    this.enrolmentService.getBuilder('search_media')
      .list()
      .then((res) => {
        this.midias = res || {};
      });
  }

  searchClient(cpf) {

    cpf = this.filterCpf(cpf);
    this.enrolmentPostService.enrolment.nucpfcnpj = cpf;

    this.enrolmentService.getBuilder('clients/' + cpf)
      .list()
      .then((res) => {
        if (res.status == 200) {
          this.enrolmentPostService.setAtributos(res.data);
        }

        if (res.status == 800) { // cpf inválido
          this.message = 'CPF inválido!';
          this.enrolmentPostService.enrolment.nucpfcnpj = null;
          this.enrolmentPostService.resetAtributos();
        }

        if (res.status == 801) { // cpf válido cliente novo
          this.enrolmentPostService.resetAtributos();
        }

      });
  }

  private filterCpf(cpf){
    cpf = cpf.replace('.', '');
    cpf = cpf.replace('.', '');
    cpf = cpf.replace('-', '');
    return cpf;
  }

  submitForm(form) {

    const cdcurso = this.enrolmentPostService.enrolment.cdcurso,
        cpf     = this.enrolmentPostService.enrolment.nucpfcnpj;

    if (form.valid) {

      this.enrolmentService.getBuilder('student/' + cpf + '/' + cdcurso)
        .list()
        .then((res) => {
          // 200 - ok | 900 - incompleta | 901 - inscricao existente
          switch (res.status) {
            case 900:
              this.incompleta = true;
              this.enrolmentPostService.enrolment.stepone = true;
              this.enrolmentPostService.enrolment.cdinscricao = res.cdinscricao;
              break;

            case 901:
              this.enrolmentPostService.enrolment.stepone = false;
              this.message = 'Identificamos que você já possui uma inscrição no curso escolhido. Favor entrar em contato no 0800 283 8380';
              break;

            default:
              this.enrolmentPostService.enrolment.stepone = true;
              this.router.navigateByUrl('/step-two');
          }
        });


    } else {
      this.enrolmentPostService.enrolment.stepone = false;
      this.message = 'Todos os campos são de preenchimento obrigatório.';
    }
  }

}
