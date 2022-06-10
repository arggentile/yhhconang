import { NgModule } from '@angular/core';
import { RouterModule, Routes } from '@angular/router';

import { DivisionEscoclarComponent } from './division-escoclar.component';

import { CreateComponent } from './create/create.component';
import { ListComponent } from './list/list.component';
import { ViewComponent } from './view/view.component';

const routes: Routes = [
  {
    path: '',
    component: DivisionEscoclarComponent,
    children: [
      {
        path: 'listado',
        component: ListComponent,
       
      },
      {
        path: 'view/:id',
        component: ViewComponent,
       
      },
      {
        path: 'form',
        component: CreateComponent,        
       
      },
      {
        path: 'form/:id',
        component: CreateComponent,
        
      },
    ]
  }
];

@NgModule({
  imports: [RouterModule.forChild(routes)],
  exports: [RouterModule]
})
export class DivisionEscolarRoutingModule { }
