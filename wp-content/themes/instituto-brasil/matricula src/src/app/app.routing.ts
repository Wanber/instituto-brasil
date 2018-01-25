import {ModuleWithProviders} from "@angular/core";
import {Routes, RouterModule} from "@angular/router";

import {StepOneComponent} from "./step-one/step-one.component";
import {StepTwoComponent} from "./step-two/step-two.component";
import {StepThreeComponent} from "./step-three/step-three.component";
import {StepFourComponent} from "./step-four/step-four.component";


const APP_ROUTES: Routes = [
  { path: '', component: StepOneComponent},
  { path: 'step-two', component: StepTwoComponent},
  { path: 'step-three', component: StepThreeComponent},
  { path: 'step-four', component: StepFourComponent}
];

export const routing: ModuleWithProviders = RouterModule.forRoot(APP_ROUTES);
