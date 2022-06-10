import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';

import { DivisionEscolarRoutingModule } from './division-escolar-routing.module';
import { ListComponent } from './list/list.component';
import { CreateComponent } from './create/create.component';
import { ViewComponent } from './view/view.component';
import { DivisionEscoclarComponent } from './division-escoclar.component';


@NgModule({
  declarations: [
    ListComponent,
    CreateComponent,
    ViewComponent,
    DivisionEscoclarComponent
  ],
  imports: [
    CommonModule,
    DivisionEscolarRoutingModule
  ]
})
export class DivisionEscolarModule { }
