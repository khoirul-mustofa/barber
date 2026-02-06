<?php

namespace App\Filament\Pages;

use App\Models\Setting;
use BackedEnum;
use Filament\Actions\Action;
use Filament\Actions\Concerns\InteractsWithActions;
use Filament\Forms\Components\TextInput;
use Filament\Notifications\Notification;
use Filament\Pages\Page;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Concerns\InteractsWithSchemas;
use Filament\Schemas\Contracts\HasSchemas;
use Filament\Schemas\Schema;
use Filament\Support\Exceptions\Halt;
use Filament\Support\Icons\Heroicon;

class ManageSettings extends Page implements HasSchemas
{
    use InteractsWithActions;
    use InteractsWithSchemas;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::Cog6Tooth;

    protected static ?string $navigationLabel = 'Settings';

    protected static ?string $title = 'Application Settings';

    protected static ?int $navigationSort = 99;

    protected string $view = 'filament.pages.manage-settings';

    /**
     * Form state
     */
    public array $data = [];

    /**
     * Fill schema state on mount
     */
    public function mount(): void
    {
        $this->schema->fill([
            'FONNTE_TOKEN' => setting('FONNTE_TOKEN'),
            'ADMIN_PHONE' => setting('ADMIN_PHONE'),
        ]);
    }

    /**
     * Define Filament Schema (v4 style)
     */
    public function schema(Schema $schema): Schema
    {
        return $schema
            ->statePath('data')
            ->components([
                Section::make('WhatsApp Integration')
                    ->description('Configure WhatsApp messaging via Fonnte API')
                    ->schema([
                        TextInput::make('FONNTE_TOKEN')
                            ->label('Fonnte API Token')
                            ->password()
                            ->revealable()
                            ->required()
                            ->maxLength(255),
                    ]),

                Section::make('Admin Contact')
                    ->description('Admin phone number for notifications')
                    ->schema([
                        TextInput::make('ADMIN_PHONE')
                            ->label('Admin Phone Numbers')
                            ->helperText('Pisahkan dengan koma. Contoh: 0823xxxx,0822xxxx')
                            ->placeholder('08xxxxxxxxxx,08xxxxxxxxxx')
                            ->required()
                            ->dehydrateStateUsing(fn ($state) => collect(explode(',', $state))
                                ->map(fn ($v) => trim($v))
                                ->implode(',')
                            )
                            ->rules([
                                function () {
                                    return function (string $attribute, $value, \Closure $fail) {
                                        foreach (explode(',', $value) as $phone) {
                                            if (! preg_match('/^08\d{8,12}$/', trim($phone))) {
                                                $fail("Format nomor tidak valid: $phone");
                                            }
                                        }
                                    };
                                },
                            ]),

                    ]),
            ]);
    }

    protected function getHeaderActions(): array
    {
        return [

            Action::make('save')
                ->label('Save Settings')
                ->icon('heroicon-o-check')
                ->color('primary')
                ->keyBindings(['mod+s'])
                ->action('save'),
        ];
    }

    /**
     * Persist settings
     */
    public function save(): void
    {
        try {
            foreach ($this->schema->getState() as $key => $value) {
                Setting::set($key, $value);
            }

            Notification::make()
                ->success()
                ->title('Settings saved')
                ->send();
        } catch (Halt $exception) {
            return;
        }
    }
}
