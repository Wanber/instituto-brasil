import {Injectable} from '@angular/core';
import {Http, Headers} from '@angular/http';

import 'rxjs/add/operator/toPromise';
import {Observable} from '@reactivex/rxjs';
import 'rxjs/add/operator/catch';


@Injectable()

export class EnrolmentService {

    private headers: Headers;
    private url: string;
    private url_salvar: string;
    private url_auth = 'http://localhost/maeli-laravel/oauth/access_token';

    private access: any = {
        client_id: 'f3d259ddd3ed8ff3843839b',
        client_secret: '4c7f6f8fa93d59c45502c0ae8c4a95b',
        grant_type: 'client_credentials'
    };
    private credentials = {access_token: null};

    constructor(private http: Http) {
        /*
        this.getAccessToken()
            .subscribe(data => {
                console.log(data.toString());
            });
        this.setAccessToken();
        */
    }

    getAccessToken() {
        const headers = new Headers({
            'Content-Type': 'application/json',
            'Accept': 'application/json'
        });

        return this.http.post(this.url_auth, JSON.stringify(this.access), {headers: headers})
            .map((res) => res.json())
            .catch((error: any) => Observable.throw(error.json().error || 'Server error'));
    }

    setAccessToken() {
        this.headers = new Headers({'Authorization': 'Bearer ' + this.credentials.access_token});
        this.headers.append('Access-Control-Allow-Origin', '*');
        this.headers.append('Access-Control-Allow-Methods', '*');
    }

    getBuilder(resource: string) {
        this.url = 'http://api.institutoprominas.com.br/unica/' + resource;
        this.url_salvar = 'http://www.institutoposbrasil.com.br/matricula?salvar';
        // this.url_salvar = 'http://www.ucamprominaspos.com.br/matricula?salvar';
        return this;
    }

    list() {
        return this.http.get(this.url)
            .toPromise()
            .then((res) => {
                return res.json() || {};
            });
    }

    insert(data: Object) {
        return this.http.post(this.url, data)
            .toPromise()
            .then((res) => {
                return res.json() || {};
            });
    }

    insertLocal(data: Object) {
        return this.http.post(this.url_salvar, data)
            .toPromise()
            .then((res) => {
                return res.json() || {};
            });
    }


}
