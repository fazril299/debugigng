<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Todos</title>
    <style>
        *{box-sizing:border-box}
        body{font-family:system-ui,sans-serif;background:#f1f5f9;margin:0;padding:2rem 1rem}
        .wrap{max-width:720px;margin:auto}
        header{display:flex;justify-content:space-between;align-items:center;margin-bottom:1rem}
        h1{margin:0;font-size:1.5rem}
        .card{background:#fff;padding:1rem 1.2rem;border-radius:12px;box-shadow:0 2px 10px rgba(0,0,0,.06);margin-bottom:.8rem}
        input,textarea,select{width:100%;padding:.55rem;border:1px solid #cbd5e1;border-radius:8px;margin-bottom:.6rem;font:inherit}
        button{padding:.5rem 1rem;border:0;border-radius:8px;cursor:pointer;background:#2563eb;color:#fff}
        .danger{background:#dc2626}.ghost{background:#64748b}
        .row{display:flex;justify-content:space-between;gap:1rem;align-items:flex-start}
        .actions{display:flex;gap:.5rem;align-items:center}
        .actions select{margin:0;width:auto}
        .badge{font-size:.75rem;padding:.15rem .6rem;border-radius:99px;background:#e2e8f0}
        .ok{background:#dcfce7;color:#166534;padding:.6rem 1rem;border-radius:8px;margin-bottom:1rem}
        p{margin:.3rem 0;color:#475569}
    </style>
</head>
<body>
<div class="wrap">
    <header>
        <h1>Todo List</h1>
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button class="ghost" type="submit">Logout</button>
        </form>
    </header>

    @if (session('success'))
        <div class="ok">{{ session('success') }}</div>
    @endif

    <div class="card">
        <form method="POST" action="{{ route('todos.store') }}">
            @csrf
            <input type="text" name="name" placeholder="Nama todo" value="{{ old('name') }}" required>
            <textarea name="description" rows="2" placeholder="Deskripsi">{{ old('description') }}</textarea>
            <button type="submit">Tambah</button>
        </form>
    </div>

    @forelse ($todos as $item)
        <div class="card">
            <div class="row">
                <div>
                    <strong>{{ $item->name }}</strong>
                    <span class="badge">{{ $item->status }}</span>
                    <p>{{ $item->description }}</p>
                </div>
                <div class="actions">
                    <form method="POST" action="{{ route('todos.status', $item->id) }}">
                        @csrf
                        @method('PUT')
                        <select name="status" onchange="this.form.submit()">
                            @foreach (['Todo', 'doing', 'done'] as $s)
                                <option value="{{ $s }}" @selected($item->status === $s)>{{ $s }}</option>
                            @endforeach
                        </select>
                    </form>
                    <form method="POST" action="{{ route('todos.destroy', $item->id) }}" onsubmit="return confirm('Hapus todo ini?')">
                        @csrf
                        @method('DELETE')
                        <button class="danger" type="submit">Hapus</button>
                    </form>
                </div>
            </div>
        </div>
    @empty
        <div class="card">Belum ada todo.</div>
    @endforelse
</div>
</body>
</html>
