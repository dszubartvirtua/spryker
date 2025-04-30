import { ChangeDetectionStrategy, Component, ViewEncapsulation } from '@angular/core';

@Component({
    selector: 'mp-welcome-message',
    templateUrl: './welcome-message.component.html',
    styleUrl: './welcome-message.component.less',
    changeDetection: ChangeDetectionStrategy.OnPush,
    encapsulation: ViewEncapsulation.None,
})
export class WelcomeMessageComponent {}
