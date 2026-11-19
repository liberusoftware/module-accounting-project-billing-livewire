<?php

declare(strict_types=1);

use Illuminate\Auth\Access\AuthorizationException;
use Liberu\Accounting\Erp\Models\User;
use Liberu\Accounting\ProjectBillingLivewire\Livewire\ProjectBillings;
use Liberu\Accounting\ProjectBillingLivewire\ProjectBillingLivewireServiceProvider;
use Livewire\Livewire;

it('renders accounting-project-billing-livewire livewire components', function (): void {
    $provider = $this->app->register(ProjectBillingLivewireServiceProvider::class, force: true);
    if (method_exists($provider, 'boot')) { $provider->boot(); }
    expect($provider)->toBeInstanceOf(ProjectBillingLivewireServiceProvider::class);

    expect(fn () => (new ProjectBillings)->mount())->toThrow(Exception::class);

    $this->actingAs(User::factory()->create());

    $component = new ProjectBillings;
    if (method_exists($component, 'mount')) { $component->mount(); }
    expect($component->render())->not->toBeNull();
});
