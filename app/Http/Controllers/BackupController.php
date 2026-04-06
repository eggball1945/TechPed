<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\Process\Process;
use Symfony\Component\Process\Exception\ProcessFailedException;

class BackupController extends Controller
{
    private function userRole()
    {
        if (Auth::guard('admin')->check()) return 'admin';
        if (Auth::guard('petugas')->check()) return 'petugas';
        return null;
    }

    public function index()
    {
        $role = $this->userRole();
        if (!$role) abort(403);
        return view("{$role}.backup.index");
    }

    public function backup()
    {
        $role = $this->userRole();
        if (!$role) abort(403);

        $dbConfig = config('database.connections.mysql');
        $filename = "backup-techped-" . date('Y-m-d_H-i-s') . ".sql";
        $filePath = storage_path("app/" . $filename);

        $command = "mysqldump --user=" . escapeshellarg($dbConfig['username']) . 
                   ($dbConfig['password'] ? " --password=" . escapeshellarg($dbConfig['password']) : "") . 
                   " --host=" . escapeshellarg($dbConfig['host']) . 
                   " " . escapeshellarg($dbConfig['database']) . 
                   " > " . escapeshellarg($filePath);

        $process = Process::fromShellCommandline($command);
        $process->run();

        if (!$process->isSuccessful()) {
            throw new ProcessFailedException($process);
        }

        return response()->download($filePath)->deleteFileAfterSend(true);
    }

    public function restore(Request $request)
    {
        $role = $this->userRole();
        if (!$role) abort(403);

        $request->validate([
            'backup_file' => 'required|file',
        ]);

        $file = $request->file('backup_file');
        $filePath = $file->getRealPath();

        $dbConfig = config('database.connections.mysql');

        $command = "mysql --user=" . escapeshellarg($dbConfig['username']) . 
                   ($dbConfig['password'] ? " --password=" . escapeshellarg($dbConfig['password']) : "") . 
                   " --host=" . escapeshellarg($dbConfig['host']) . 
                   " " . escapeshellarg($dbConfig['database']) . 
                   " < " . escapeshellarg($filePath);

        $process = Process::fromShellCommandline($command);
        $process->run();

        if (!$process->isSuccessful()) {
            return back()->with('error', 'Restore gagal: ' . $process->getErrorOutput());
        }

        return back()->with('success', 'Database berhasil direstore.');
    }
}
