<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">
    <link rel="shortcut icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">
    <title>Pre Inscripción UNESR 2026 | PNF Fisioterapia</title>
    
    <style>
        /* Esto pone las letras en mayúsculas visualmente mientras escriben */
input { 
    text-transform: uppercase; 
}

/* Opcional: para que el texto de ayuda (placeholder) se mantenga normal */
input::placeholder {
    text-transform: none;
}

        body { background-color: #f1f5f9; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; margin: 0; display: flex; align-items: center; justify-content: center; min-height: 100vh; }
        .card { background: white; width: 1100px; display: flex; border-radius: 40px; overflow: hidden; box-shadow: 0 25px 50px -12px rgba(0,0,0,0.2); min-height: 600px; }
        
        /* Lado Azul Institucional */
        .info-side { background: #004a99; color: white; padding: 60px; width: 45%; display: flex; flex-direction: column; justify-content: flex-start; position: relative; }
        
        .header-unesr { display: flex; align-items: center; margin-bottom: 30px; }
        .logo-circle { background: white; width: 80px; height: 80px; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin-right: 20px; flex-shrink: 0; box-shadow: 0 10px 20px rgba(0,0,0,0.2); }
        .logo-circle img { width: 75%; height: auto; }
        .unesr-title { font-size: 18px; margin: 0; text-transform: uppercase; font-weight: 800; line-height: 1.2; letter-spacing: 0.5px; }
        
        .tag { background: rgba(255,255,255,0.2); display: inline-block; padding: 5px 15px; border-radius: 50px; font-size: 10px; font-weight: bold; margin-bottom: 30px; letter-spacing: 2px; }
        
        .pnf-main-title { font-size: 55px; font-weight: 900; line-height: 0.9; margin: 0; color: white; text-transform: uppercase; letter-spacing: -2px; }
        .pnf-subtitle { font-size: 35px; font-weight: 300; color: #bfdbfe; display: block; margin-top: 5px; }

        /* Estilo de la Frase - Más grande y arriba */
        .quote { 
            border-left: 5px solid #60a5fa; 
            padding-left: 20px; 
            font-size: 16px; /* Más grande */
            margin-top: 50px; /* Posicionada más arriba */
            margin-bottom: 30px;
            color: #d1d5db;
            font-style: italic; 
            line-height: 1.5; 
            max-width: 90%;
        }
        .quote-author { display: block; margin-top: 10px; font-weight: bold; color: white; font-size: 14px; text-transform: uppercase; letter-spacing: 1px; }

        /* Lado Formulario */
        .form-side { padding: 60px; width: 55%; background: white; display: flex; flex-direction: column; justify-content: center; }
        h3 { font-size: 30px; color: #1e293b; margin: 0 0 10px; font-style: italic; }
        label { display: block; font-size: 10px; font-weight: bold; color: #94a3b8; text-transform: uppercase; margin-bottom: 8px; letter-spacing: 1px; }
        input, select { width: 100%; padding: 18px; border-radius: 20px; border: 1px solid #e2e8f0; background: #f8fafc; margin-bottom: 25px; box-sizing: border-box; font-size: 15px; outline: none; transition: 0.3s; }
        
        button { width: 100%; padding: 22px; background: #004a99; color: white; border: none; border-radius: 25px; font-weight: bold; cursor: pointer; font-size: 14px; text-transform: uppercase; letter-spacing: 2px; transition: 0.3s; margin-top: 10px; }
        button:hover { background: #0f172a; transform: translateY(-2px); box-shadow: 0 10px 20px rgba(0,0,0,0.1); }
        
        .error-box { background: #fee2e2; border-left: 4px solid #ef4444; padding: 15px; border-radius: 15px; margin-bottom: 20px; color: #b91c1c; font-size: 12px; font-weight: bold; }
    </style>
</head>
<body>

    <div class="card">
        <!-- LADO AZUL -->
        <div class="info-side">
            <div class="header-unesr">
                <div class="logo-circle">
                    <img src="{{ asset('img/logo.png') }}" alt="UNESR">
                </div>
                <h1 class="unesr-title">Universidad Nacional Experimental<br>Simón Rodríguez</h1>
            </div>

            <div class="tag">PROCESO DE INSCRIPCIÓN 2026</div>
            
            <p class="pnf-main-title italic">PNF<br><span class="pnf-subtitle">FISIOTERAPIA</span></p>

            <!-- Frase optimizada -->
            <div class="quote">
                "La enseñanza de los niños debe ser siempre alegre, católica, instructiva y propia de su edad."
                <span class="quote-author">— Simón Rodríguez</span>
            </div>
        </div>

        <!-- LADO FORMULARIO -->
        <div class="form-side">
            <h3>Registro de Datos</h3>
            <p style="color: #94a3b8; font-size: 14px; margin-bottom: 35px;">Complete los campos para procesar su preinscripción académica.</p>

            @if ($errors->any())
                <div class="error-box">{{ $errors->first() }}</div>
            @endif

            <form action="{{ route('inscribir') }}" method="POST">
                @csrf
                <label>Cédula del Estudiante</label>
                <input type="text" name="cedula" placeholder="V-00.000.000" value="{{ old('cedula') }}" required>

                <label>Nombre y Apellido</label>
                <input type="text" name="nombre_apellido" placeholder="Nombre completo" value="{{ old('nombre_apellido') }}" required>

                <label>Unidad Curricular / Sección</label>
                <select name="materia_id" required>
                    @foreach(\App\Models\Materia::all() as $m)
                        <option value="{{ $m->id }}">
                            {{ $m->nombre }} — {{ 25 - $m->cupo_actual }} Cupos Libres
                        </option>
                    @endforeach
                </select>

                <button type="submit">Procesar Inscripción</button>
            </form>
            <p style="text-align: center; margin-top: 45px; font-size: 10px; color: #cbd5e1; font-weight: bold; letter-spacing: 3px;">UNESR CONTROL DE ESTUDIOS © 2026</p>
        </div>
    </div>

</body>
</html>
