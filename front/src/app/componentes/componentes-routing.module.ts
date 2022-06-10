import { NgModule } from '@angular/core';
import { RouterModule, Routes } from '@angular/router';

import { RoutingComponent } from './routing.component';

const routes: Routes = [
  {
    path: '',
    component: RoutingComponent,
    children: [
      {
        path: 'establecimiento',
        loadChildren: () => import('./establecimiento/establecimiento.module').then(module => module.EstablecimientoModule),
        //loadChildren: 'src/app/components/servicio-ofrecido/servicio-ofrecido.module#ServicioOfrecidoModule'
        // loadChildren: () => import('./grupo-familiar/grupo-familiar.module').then(module => module.GrupoFamiliarModule)
      },
      {
        path: 'division-escolar',
        loadChildren: () => import('./division-escolar/division-escolar.module').then(module => module.DivisionEscolarModule),
        //loadChildren: 'src/app/components/servicio-ofrecido/servicio-ofrecido.module#ServicioOfrecidoModule'
        // loadChildren: () => import('./grupo-familiar/grupo-familiar.module').then(module => module.GrupoFamiliarModule)
      }
    ]
  },

];

@NgModule({
  imports: [RouterModule.forChild(routes)],
  exports: [RouterModule]
})
export class ComponentesRoutingModule { }
