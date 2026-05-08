<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <link rel="icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">
    <link rel="shortcut icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">
    
    <title>Comprobante de Preinscripción | UNESR</title>
    <style>
        body { background-color: #f1f5f9; font-family: 'Segoe UI', sans-serif; margin: 0; display: flex; align-items: center; justify-content: center; min-height: 100vh; }
        .card { background: white; width: 500px; padding: 40px; border-radius: 30px; text-align: center; box-shadow: 0 20px 50px rgba(0,0,0,0.1); border: 1px solid #eee; }
        
        /* Estilos para el Logo en el PDF */
        .header-print { margin-bottom: 20px; display: flex; flex-direction: column; align-items: center; }
        .logo-print { width: 80px; height: 80px; margin-bottom: 10px; }
        
        h2 { color: #1e293b; margin: 0; font-size: 24px; font-weight: 800; text-transform: uppercase; }
        .info-box { background: #f8fafc; border-radius: 20px; padding: 25px; text-align: left; margin: 25px 0; border: 1px solid #e2e8f0; }
        .label { font-size: 10px; font-weight: bold; color: #94a3b8; text-transform: uppercase; margin-bottom: 2px; display: block; }
        .data { font-weight: bold; color: #1e293b; font-size: 16px; margin-bottom: 12px; display: block; text-transform: uppercase; }
        
        /* Código de Seguridad */
        .security-code { border: 2px dashed #004a99; padding: 15px; border-radius: 15px; background: #f0f7ff; margin-top: 20px; }
        .code-text { font-family: monospace; font-size: 22px; font-weight: 900; color: #004a99; letter-spacing: 2px; }

        button { width: 100%; padding: 20px; background: #004a99; color: white; border: none; border-radius: 20px; font-weight: bold; cursor: pointer; text-transform: uppercase; transition: 0.3s; margin-top: 20px; }
        @media print { .no-print { display: none; } body { background: white; padding: 0; } .card { box-shadow: none; border: 2px solid #333; width: 100%; } }
    </style>
</head>
<body>

    <div class="card">
        <div class="header-print">
            <!-- El logo se verá en el PDF -->
            <img src="{{ asset('img/logo.png') }}" class="logo-print">
            <h2>UNESR - COMPROBANTE</h2>
            <p style="font-size: 10px; font-weight: bold; color: #64748b; margin-top: 5px;">PROCESO DE INSCRIPCIÓN 2026</p>
        </div>

        <div class="info-box">
            <span class="label">Estudiante</span>
            <span class="data">{{ $inscripcion->nombre_apellido }}</span>
            
            <span class="label">Cédula</span>
            <span class="data">{{ $inscripcion->cedula }}</span>

            <span class="label">Materia Inscrita</span>
            <span class="data" style="color: #004a99;">{{ $inscripcion->materia->nombre }}</span>
        </div>

        <div class="security-code">
            <span class="label" style="color: #004a99;">CÓDIGO DE VERIFICACIÓN</span>
            <span class="code-text">{{ $inscripcion->codigo_verificacion }}</span>
        </div>

        <button class="no-print" onclick="window.print()">Descargar Planilla (PDF)</button>
        
        <div class="no-print" style="margin-top: 20px;">
            <a href="/" style="color: #94a3b8; font-size: 11px; font-weight: bold; text-decoration: none; text-transform: uppercase;">Volver al inicio</a>
        </div>
    </div>

</body>
</html>
