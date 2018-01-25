import {Injectable} from '@angular/core';

@Injectable()
export class EnrolmentPostService {

    public enrolment: any = {
        cdtpcurso: 1,
        cdcurso_area: null,
        cdcurso: null,
        nucpfcnpj: null,
        nmcliente: null,
        email: null,
        telefone1: null,
        telefone2: null,
        cdmidia: null,
        optin: false,
        cdcliente: null,
        cdinscricao: null,

        nuidentidade: null,
        cdestado_civil: null,
        sexo: null,
        endereco: null,
        complemento: null,
        numero: null,
        bairro: null,
        cep: null,
        cdestado: null,
        cdcidade: null,
        orgaoexpedidor: null,
        dtnascimento: null,
        cdformacaoescolar: null,
        nmcursograduacao: null,
        dtcolacaodegrau: null,
        cdestadonaturalidade: null,
        cdcidadenaturalidade: null,
        nmpai: null,
        nmmae: null,

        planoinscricao: null,
        dtpagtoinscricao: null,
        planomensalidade: null,
        diapagamento: null,
        mesiniciocobranca: null,
        planomaterial: null,
        dtpagtomaterial: null,

        termociencia: 'S',
        stepone: false
    };

    constructor() {
    }

    setAtributos(data) {
        this.enrolment.cdcliente = data.cdcliente;
        this.enrolment.nuidentidade = data.nuidentidade;
        this.enrolment.cdestado_civil = data.cdestado_civil;
        this.enrolment.sexo = data.sexo;
        this.enrolment.nmcliente = data.nmcliente;
        this.enrolment.email = data.email;
        this.enrolment.telefone1 = data.telefone1;
        this.enrolment.telefone2 = data.telefone2;
        this.enrolment.endereco = data.endereco;
        this.enrolment.complemento = data.complemento;
        this.enrolment.numero = data.numero;
        this.enrolment.bairro = data.bairro;
        this.enrolment.cep = data.cep;
        this.enrolment.cdestado = data.cdestado;
        this.enrolment.cdcidade = data.cdcidade;
        this.enrolment.orgaoexpedidor = data.orgaoexpedidor;
        this.enrolment.dtnascimento = data.dtnascimento;
        this.enrolment.cdformacaoescolar = data.cdformacaoescolar;
        this.enrolment.nmcursograduacao = data.nmcursograduacao;
        this.enrolment.dtcolacaodegrau = data.dtcolacaodegrau;
        this.enrolment.cdestadonaturalidade = data.cdestadonaturalidade;
        this.enrolment.cdcidadenaturalidade = data.cdcidadenaturalidade;
        this.enrolment.nmpai = data.nmpai;
        this.enrolment.nmmae = data.nmmae;
    }

    resetAtributos() {
        this.enrolment.cdcliente = null;
        this.enrolment.nuidentidade = null;
        this.enrolment.cdestado_civil = null;
        this.enrolment.sexo = null;
        this.enrolment.nmcliente = null;
        this.enrolment.email = null;
        this.enrolment.telefone1 = null;
        this.enrolment.telefone2 = null;
        this.enrolment.endereco = null;
        this.enrolment.complemento = null;
        this.enrolment.numero = null;
        this.enrolment.bairro = null;
        this.enrolment.cep = null;
        this.enrolment.cdestado = null;
        this.enrolment.cdcidade = null;
        this.enrolment.orgaoexpedidor = null;
        this.enrolment.dtnascimento = null;
        this.enrolment.cdformacaoescolar = null;
        this.enrolment.nmcursograduacao = null;
        this.enrolment.dtcolacaodegrau = null;
        this.enrolment.cdestadonaturalidade = null;
        this.enrolment.cdcidadenaturalidade = null;
        this.enrolment.nmpai = null;
        this.enrolment.nmmae = null;
    }

    setAddress(data) {
        this.enrolment.endereco = data.logradouro;
        this.enrolment.complemento = data.complemento;
        this.enrolment.bairro = data.bairro;
    }

}
