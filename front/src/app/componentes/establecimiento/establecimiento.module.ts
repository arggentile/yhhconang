import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';

import {ReactiveFormsModule  } from '@angular/forms'

import { EstablecimientoRoutingModule } from './establecimiento-routing.module';


import { ViewComponent } from './view/view.component';
import { CreateComponent } from './create/create.component';
import { ListComponent } from './list/list.component';
import { EstablecimientoComponent } from './establecimiento.component';


@NgModule({
  declarations: [
    ViewComponent,
    CreateComponent,
    ListComponent,
    EstablecimientoComponent
  ],
  imports: [
    CommonModule,
    ReactiveFormsModule,
    EstablecimientoRoutingModule
  ]
})
export class EstablecimientoModule { }
