// Registration
import { NgModule } from '@angular/core';
import { WebComponentsModule } from '@spryker/web-components';

import {WelcomeMessageComponent} from './welcome-message/welcome-message.component';
import {WelcomeMessageModule} from './welcome-message/welcome-message.module';

@NgModule({
    imports: [
        WebComponentsModule.withComponents([WelcomeMessageComponent]),
        WelcomeMessageModule,
    ],
    providers: [],
})
export class ComponentsModule {}
