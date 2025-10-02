<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;

class ShowLoginCredentials extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:show-credentials';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Display login credentials for testing accounts';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('🔐 LOGIN CREDENTIALS FOR TESTING');
        $this->line('');

        // Get admin accounts
        $admins = User::where('role', 'admin')->get();
        if ($admins->count() > 0) {
            $this->info('👨‍💼 ADMIN ACCOUNTS:');
            foreach ($admins as $admin) {
                if ($admin->email !== 'visitor@dummy.local') {
                    $password = $admin->email === 'admin@sekolah.id' ? 'admin123' : 'unknown';
                    $this->line("  📧 Email: {$admin->email}");
                    $this->line("  🔑 Password: {$password}");
                    $this->line("  👤 Name: {$admin->nama}");
                    $this->line('');
                }
            }
        }

        // Get teacher accounts
        $teachers = User::where('role', 'guru')
                       ->where('email', '!=', 'visitor@dummy.local')
                       ->get();
        
        if ($teachers->count() > 0) {
            $this->info('👨‍🏫 TEACHER ACCOUNTS:');
            foreach ($teachers as $teacher) {
                $this->line("  📧 Email: {$teacher->email}");
                $this->line("  🔑 Password: guru123");
                $this->line("  👤 Name: {$teacher->nama}");
                $this->line("  🏢 Division: {$teacher->divisi}");
                $this->line('');
            }
        }

        $this->info('🚀 TO LOGIN:');
        $this->line('1. Open your browser and go to the application');
        $this->line('2. Click "Login Staff" button');
        $this->line('3. Use any of the credentials above');
        $this->line('');
        
        $this->warn('⚠️  Change passwords before production!');
    }
}
