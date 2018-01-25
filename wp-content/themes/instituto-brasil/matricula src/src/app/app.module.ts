import { BrowserModule } from '@angular/platform-browser';
import { NgModule } from '@angular/core';
import { FormsModule } from '@angular/forms';
import { HttpModule } from '@angular/http';

import { AppComponent } from './app.component';
import { StepOneComponent } from './step-one/step-one.component';
import { StepTwoComponent } from './step-two/step-two.component';
import { StepThreeComponent } from './step-three/step-three.component';
import { routing } from './app.routing';
import {EnrolmentService} from "./enrolment.service";
import {EnrolmentPostService} from "./enrolment-post.service";
import { ModalModule, TabsModule } from 'ngx-bootstrap';
import { TextMaskModule } from 'angular2-text-mask';
import {CepService} from "./cep.service";
import { StepFourComponent } from './step-four/step-four.component';

@NgModule({
  declarations: [
    AppComponent,
    StepOneComponent,
    StepTwoComponent,
    StepThreeComponent,
    StepFourComponent
  ],
  imports: [
    BrowserModule,
    FormsModule,
    HttpModule,
    routing,
    ModalModule.forRoot(),
    TabsModule.forRoot(),
    TextMaskModule
  ],
  providers: [EnrolmentService, EnrolmentPostService, CepService],
  bootstrap: [AppComponent]
})

export class AppModule { }
