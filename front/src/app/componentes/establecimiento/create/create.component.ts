import { Component, OnInit } from '@angular/core';
import { FormControl, Validators, FormGroup } from '@angular/forms';

import { Establecimiento} from '@shared/interfecs/IEstablecimiento.interface';

@Component({
  selector: 'app-create',
  templateUrl: './create.component.html',
  styleUrls: ['./create.component.css']
})
export class CreateComponent implements OnInit {
  form = new FormGroup({
    fieldNombre: new FormControl('', Validators.required),
    fieldNivelEducativo: new FormControl('Nivel Eductivoo', Validators.required),
    fieldCalle: new FormControl('Calle'),
    fieldTelefono: new FormControl('Telefono')
  });
  /*fieldNombre = new FormControl('', Validators.required);
  fieldNivelEducativo = new FormControl('Nivel Eductivoo', Validators.required);
  fieldCalle = new FormControl('Calle');
  fieldTelefono = new FormControl('Telefono');*/
  
  constructor() { }

  ngOnInit(): void {
   /* this.fieldNombre.valueChanges
    .subscribe( value => {
      console.log("El valoir es: "  + value);
    })*/
  }

}
