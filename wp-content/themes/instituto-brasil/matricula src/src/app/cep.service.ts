import { Injectable } from '@angular/core';
import {Http} from "@angular/http";

import 'rxjs/add/operator/toPromise';

@Injectable()
export class CepService {

  private url:string;

  constructor(private http: Http) { }

  getCep(cep:number){
    this.url = 'https://viacep.com.br/ws/' + cep + '/json/';
    return this;
  }

  list(){
    return this.http.get(this.url)
      .toPromise()
      .then((res) => {
        return res.json() || {};
      });
  }

}
