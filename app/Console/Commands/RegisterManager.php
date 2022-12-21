<?php

namespace App\Console\Commands;

use App\Models\Manager;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\Password;

class RegisterManager extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'manager:register';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Manually register a manager';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $manager = new Manager();
        $manager->name = $this->ask('Nom');

        $email = $this->ask('Email');
        if (Manager::whereEmail($email)->exists()) {
            $this->error('Un manager existe déjà avec cette adresse !');

            return 1;
        }
        $manager->email = $email;

        do {
            $password = $this->secret('Mot de passe');

            $validator = Validator::make([
                'password' => $password,
                'password_confirmation' => $password,
            ], [
                'password' => Password::required(),
            ]);

            if (array_key_exists('password', $validator->valid())) {
                $manager->password = Hash::make($password);
            } else {
                foreach ($validator->messages()->get('password') as $message) {
                    $this->error($message);
                }
            }
        } while (!$manager->password);
        $manager->save();

        $this->info("Manager #{$manager->id} créé.");

        return 0;
    }
}
