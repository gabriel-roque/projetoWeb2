import {NgModule} from '@angular/core';
import {FormsModule} from '@angular/forms';
import {BrowserModule} from '@angular/platform-browser';
import {NgbModule} from '@ng-bootstrap/ng-bootstrap';

import {AppRoutingModule} from './app-routing.module';
import {AppComponent} from './app.component';
import { FontAwesomeModule } from '@fortawesome/angular-fontawesome';
import {CoreModule} from './core/core.module';

import {CategoriasModule} from './categorias/categorias.module';
import {LivrosModule} from './livros/livros.module';
import {UsuariosModule} from './usuarios/usuarios.module';

@NgModule({
  declarations: [
    AppComponent,
  ],
  imports: [
    BrowserModule,
    AppRoutingModule,
    FormsModule,
    NgbModule,
    FontAwesomeModule,
    CoreModule,
    CategoriasModule,
    LivrosModule,
    UsuariosModule
  ],
  providers: [],
  bootstrap: [AppComponent]
})
export class AppModule {
}
