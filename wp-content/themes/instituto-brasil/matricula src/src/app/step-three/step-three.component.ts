import {Component, OnInit} from '@angular/core';
import {EnrolmentService} from '../enrolment.service';
import {EnrolmentPostService} from '../enrolment-post.service';

@Component({
    selector: 'app-step-three',
    templateUrl: './step-three.component.html',
    styleUrls: ['./step-three.component.css']
})
export class StepThreeComponent implements OnInit {

    public enrolment: any;
    public course: any = [];
    public naturalidade: any = [];
    public citystate: any = [];
    public graduation: any = [];
    public planeenrolment: any = {parcela: null, valor: null};
    public planecourse: any = {parcela: null, valor: null};
    public planematerial: any = {parcela: null, valor: null};

    constructor(private enrolmentService: EnrolmentService, private enrolmentPostService: EnrolmentPostService) {
        this.enrolment = this.enrolmentPostService.enrolment;
        this.getCourse();
        this.getNaturalidade();
        this.getCity();
        this.getGraduation();
        this.getPlaneEnrolment();
        this.getPlaneCourse();
        this.getPlaneMaterial();
    }

    ngOnInit() {
    }

    getCourse() {
        this.enrolmentService.getBuilder('search_course/' + this.enrolmentPostService.enrolment.cdcurso)
            .list()
            .then((res) => {
                this.course = res || {};
            });
    }

    getNaturalidade() {
        this.enrolmentService.getBuilder('citystatename/' + this.enrolmentPostService.enrolment.cdcidadenaturalidade)
            .list()
            .then((res) => {
                this.naturalidade = res || {};
            });
    }

    getCity() {
        this.enrolmentService.getBuilder('citystatename/' + this.enrolmentPostService.enrolment.cdcidade)
            .list()
            .then((res) => {
                this.citystate = res || {};
            });
    }

    getGraduation() {
        this.enrolmentService.getBuilder('graduation/' + this.enrolmentPostService.enrolment.cdformacaoescolar)
            .list()
            .then((res) => {
                this.graduation = res || {};
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

}