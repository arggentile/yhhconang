import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';

import { ComponentesRoutingModule } from './componentes-routing.module';
import { RoutingComponent } from './routing.component';


@NgModule({
  declarations: [
    RoutingComponent
  ],
  imports: [
    CommonModule,
    ComponentesRoutingModule
  ]
})
export class ComponentesModule { }
