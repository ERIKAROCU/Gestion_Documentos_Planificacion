<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use app\Models\Oficina;

class OficinasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\Oficina::create(['nombre' => 'Oficina Central']);
        \App\Models\Oficina::create(['nombre' => 'Gerencia de Planeamiento y Desarrollo Institucional']);
        \App\Models\Oficina::create(['nombre' => 'Subgerencia de Planeamiento Estratégico y Modernización de la Gestión Pública']);
        \App\Models\Oficina::create(['nombre' => 'Subgerencia de Programación de Inversión y Cooperación Técnica Nacional e Internacional']);
        \App\Models\Oficina::create(['nombre' => 'Subgerencia de Estudios Definitivos de Proyectos de Inversión Pública']);
        \App\Models\Oficina::create(['nombre' => 'Subgerencia de Planeamiento, Control Urbano, Rural y Catastro']);
        \App\Models\Oficina::create(['nombre' => 'Gerencia de Infraestructura']);
        \App\Models\Oficina::create(['nombre' => 'Subgerencia de Obras Públicas y Mantenimiento']);
        \App\Models\Oficina::create(['nombre' => 'Subgerencia de Catastro, Control Urbano y Rural']);
        \App\Models\Oficina::create(['nombre' => 'Gerencia de Desarrollo Económico y Medio Ambiente']);
        \App\Models\Oficina::create(['nombre' => 'Subgerencia de Comercialización, Mercados y Actividades Económicas']);
        \App\Models\Oficina::create(['nombre' => 'Subgerencia del Medio Ambiente, Salud Pública, Ornato de la Ciudad y OMSABA']);
        \App\Models\Oficina::create(['nombre' => 'Subgerencia de Promoción Empresarial y Gestión de Proyectos Productivos']);
        \App\Models\Oficina::create(['nombre' => 'Gerencia de Desarrollo Social y Servicios Públicos']);
        \App\Models\Oficina::create(['nombre' => 'Subgerencia de Promoción Social y Participación Ciudadana']);
        \App\Models\Oficina::create(['nombre' => 'Subgerencia de Cultura, Educación, Turismo y Deporte']);
        \App\Models\Oficina::create(['nombre' => 'Subgerencia de Seguridad Ciudadana']);
        \App\Models\Oficina::create(['nombre' => 'Subgerencia de Protección a los Grupos Vulnerables']);
        \App\Models\Oficina::create(['nombre' => 'Gerencia de Administración']);
        \App\Models\Oficina::create(['nombre' => 'Subgerencia de Recursos Humanos']);
        \App\Models\Oficina::create(['nombre' => 'Subgerencia de Logística y Control Patrimonial']);
        \App\Models\Oficina::create(['nombre' => 'Subgerencia de Contabilidad, Integración y Finanzas']);
        \App\Models\Oficina::create(['nombre' => 'Subgerencia de Tesorería']);
        \App\Models\Oficina::create(['nombre' => 'Oficina de Asesoría Jurídica']);
        \App\Models\Oficina::create(['nombre' => 'Oficina de Supervisión y Liquidación de Proyectos de Inversión Pública']);
        \App\Models\Oficina::create(['nombre' => 'Oficina de Administración Tributaria y Recaudación']);
        \App\Models\Oficina::create(['nombre' => 'Oficina de Tecnología e Informática']);
        \App\Models\Oficina::create(['nombre' => 'Oficina de Registro Civil']);
        \App\Models\Oficina::create(['nombre' => 'Oficina de OMAPED']);
        \App\Models\Oficina::create(['nombre' => 'Oficina de Defensa Civil']);
        \App\Models\Oficina::create(['nombre' => 'Oficina de Ejecución Coactiva']);
        \App\Models\Oficina::create(['nombre' => 'Oficina de Relaciones Públicas']);
        \App\Models\Oficina::create(['nombre' => 'Oficina de Mesa de Partes Virtual']);

    }
}
