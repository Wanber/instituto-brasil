import {Component, OnInit} from '@angular/core';
import {EnrolmentService} from '../enrolment.service';
import {EnrolmentPostService} from '../enrolment-post.service';

@Component({
    selector: 'app-step-four',
    templateUrl: './step-four.component.html',
    styleUrls: ['./step-four.component.css']
})
export class StepFourComponent implements OnInit {

    public result: any = [];
    public document: any = [];

    public enrolment: any;
    public course: any = [];
    public naturalidade: any = [];
    public citystate: any = [];
    public graduation: any = [];
    public planeenrolment: any = {parcela: null, valor: null};
    public planecourse: any = {parcela: null, valor: null};
    public planematerial: any = {parcela: null, valor: null};

    private num_processados = 0;

    constructor(private enrolmentService: EnrolmentService, private enrolmentPostService: EnrolmentPostService) {
    }

    ngOnInit() {
        this.getDocument();

        this.enrolment = this.enrolmentPostService.enrolment;
        this.getPlaneEnrolment();
        this.getPlaneCourse();
        this.getPlaneMaterial();
        this.getCourse();
        this.getNaturalidade();
        this.getCity();
        this.getGraduation();

        // this.onSubmit();
    }

    /*
    onSubmit() {
      this.enrolmentService.getBuilder('enrolment')
        .insert(this.enrolmentPostService.enrolment)
        .then((res) => {
          this.result = res || {};
        })
    }*/

    onSubmit() {

        if (this.num_processados < 4) {
            return;
        }

        const dados = {
            curso: this.course,
            naturalidade: this.naturalidade,
            cidade: this.citystate,
            graduacao: this.graduation,
            plano: this.planeenrolment,
            plano_curso: this.planecourse,
            plano_material: this.planematerial
        };

        this.enrolment.dados = dados;

        this.enrolmentService.getBuilder('enrolment')
            .insertLocal(this.enrolment)
            .then((res) => {
                this.result = res || {};
            });

    }

    getDocument() {
        this.enrolmentService.getBuilder('document/1')
            .list()
            .then((res) => {
                this.document = res || {};
            });
    }


    getPlaneEnrolment() {
        const v = this.enrolmentPostService.enrolment.planoinscricao;
        const e = v.split('-');
        this.planeenrolment.parcela = e[0];
        this.planeenrolment.valor = e[1];
    }

    getPlaneCourse() {
        const v = this.enrolmentPostService.enrolment.planomensalidade;
        const e = v.split('-');
        this.planecourse.parcela = e[0];
        this.planecourse.valor = e[1];
    }

    getPlaneMaterial() {
        const v = this.enrolmentPostService.enrolment.planomaterial;
        if (v !== 0) {
            const e = v.split('-');
            this.planematerial.parcela = e[0];
            this.planematerial.valor = e[1];
        }
    }

    getCourse() {
        this.enrolmentService.getBuilder('search_course/' + this.enrolmentPostService.enrolment.cdcurso)
            .list()
            .then((res) => {
                this.course = res || {};
                this.num_processados++;
                this.onSubmit();
            });
    }

    getNaturalidade() {
        this.enrolmentService.getBuilder('citystatename/' + this.enrolmentPostService.enrolment.cdcidadenaturalidade)
            .list()
            .then((res) => {
                this.naturalidade = res || {};
                this.num_processados++;
                this.onSubmit();
            });
    }

    getCity() {
        this.enrolmentService.getBuilder('citystatename/' + this.enrolmentPostService.enrolment.cdcidade)
            .list()
            .then((res) => {
                this.citystate = res || {};
                this.num_processados++;
                this.onSubmit();
            });
    }

    getGraduation() {
        this.enrolmentService.getBuilder('graduation/' + this.enrolmentPostService.enrolment.cdformacaoescolar)
            .list()
            .then((res) => {
                this.graduation = res || {};
                this.num_processados++;
                this.onSubmit();
            });
    }
}
