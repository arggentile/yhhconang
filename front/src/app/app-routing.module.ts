import { NgModule } from '@angular/core';
import { Routes, RouterModule } from '@angular/router';

import { AppComponent } from './app.component';
import { UnoComponent } from './components/uno/uno.component';
import { DosComponent } from './components/dos/dos.component';
import { TresComponent } from './components/tres/tres.component';

/*
import { AdminComponent } from './theme/layout/admin/admin.component';
import {AuthComponent} from './theme/layout/auth/auth.component';
*/

/*
const routes: Routes = [
  {
    path: 'cpp',
    component: AdminComponent,
    loadChildren: () => import('./components/components.module').then(module => module.ComponentsModule),
  },
  {
    path: 'login',
    loadChildren: () => import('./core/login/login.module').then(module => module.LoginModule)
  },
  {
    path: 'logout',
    loadChildren: () => import('./core/logout/logout.module').then(module => module.LogoutModule)
  },

  {
    path: '',
    component: AdminComponent,
    children: [
      {
        path: '',
        redirectTo: 'dashboard/analytics',
        pathMatch: 'full'
      },
      {
        path: 'dashboard',
        loadChildren: () => import('./demo/dashboard/dashboard.module').then(module => module.DashboardModule)
      },
      {
        path: 'layout',
        loadChildren: () => import('./demo/pages/layout/layout.module').then(module => module.LayoutModule)
      },
      {
        path: 'basic',
        loadChildren: () => import('./demo/ui-elements/ui-basic/ui-basic.module').then(module => module.UiBasicModule)
      },
      {
        path: 'forms',
        loadChildren: () => import('./demo/pages/form-elements/form-elements.module').then(module => module.FormElementsModule)
      },
      {
        path: 'tbl-bootstrap',
        loadChildren: () => import('./demo/pages/tables/tbl-bootstrap/tbl-bootstrap.module').then(module => module.TblBootstrapModule)
      },
      {
        path: 'charts',
        loadChildren: () => import('./demo/pages/core-chart/core-chart.module').then(module => module.CoreChartModule)
      },
      {
        path: 'sample-page',
        loadChildren: () => import('./demo/pages/sample-page/sample-page.module').then(module => module.SamplePageModule)
      }
    ]
  },
  {
    path: '',
    component: AuthComponent,
    children: [
      {
        path: 'auth',
        loadChildren: () => import('./demo/pages/authentication/authentication.module').then(module => module.AuthenticationModule)
      },
      {
        path: 'maintenance',
        loadChildren: () => import('./demo/pages/maintenance/maintenance.module').then(module => module.MaintenanceModule)
      }
    ]
  }
];
*/

const routes: Routes = [ 
  {
    path: '',
    redirectTo: 'inicio',
    pathMatch: 'full'
  },

  {
    path: 'cmp',
    loadChildren: () => import('./componentes/componentes.module').then(module => module.ComponentesModule)   
  },
  
  {
    path: 'inicio',
    component: AppComponent,
    //loadChildren: () => import('./components/components.module').then(module => module.ComponentsModule),
  },
  {
    path: 'uno',
    component: UnoComponent,
    //loadChildren: () => import('./components/components.module').then(module => module.ComponentsModule),
  },
  {
    path: 'dos',
    component: DosComponent,
    //loadChildren: () => import('./components/components.module').then(module => module.ComponentsModule),
  },
];
@NgModule({
  imports: [RouterModule.forRoot(routes)],
  exports: [RouterModule]
})
export class AppRoutingModule { }
