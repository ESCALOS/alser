<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FaqSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faqs = [
            [
                'question' => '¿Cuánto es la comisión por usar Alser Cambio?',
                'answer' => 'En Alser Cambio no cobramos comisión por el uso de nuestros servicios. Sin embargo, puede ser que el banco del cual nos transfieres cobre una comisión, en caso quieras transferir desde provincia o realizar una transferencia interbancaria.',
            ],
            [
                'question' => '¿Con qué bancos opera Alser Cambio?',
                'answer' => 'Trabajamos directamente con Interbank. Por lo tanto, los usuarios podrán realizar sus operaciones desde su banca móvil, pero las operaciones interbancarias estarán sujetas a comisión dependiendo de la política del banco de procedencia.',
            ],
            [
                'question' => '¿Qué es PEP?',
                'answer' => 'PEP (persona expuesta políticamente) son personas naturales, nacionales o extranjeras, que cumplen o hayan cumplido funciones públicas, sea en el territorio nacional o extranjero y cuyas circunstancias financieras puedan ser objeto de un interés público. Incluye a sus parientes hasta segundo grado de consanguinidad, segundo de afinidad y al cónyuge. Una persona deja de ser PEP hasta 5 años después de culminado su contrato. Asimismo, estas personas pueden realizar operaciones en Alser Cambio siempre y cuando completen el formulario PEP que se les enviará por correo electrónico.',
            ],
            [
                'question' => '¿Puedo cambiar mi correo electrónico?',
                'answer' => 'La dirección de correo electrónico podrá ser cambiada enviándonos un correo a info@alsercambio.com o cuando el usuario este en el proceso de registro antes de validar su correo.',
            ],
            [
                'question' => '¿Existen comisiones por transferencia?',
                'answer' => 'Alser Cambio no cobra comisiones. Pero si tu transferencia es interbancaria, entonces esta puede estar sujeta a una comisión según la política de tu banco.',
            ],
            [
                'question' => '¿Recibo una boleta por realizar una operación en cambio seguro?',
                'answer' => 'Sí, al cabo de 24 horas realizada la operación se le mandará la boleta a su correo registrado al momento de crear su usuario, para perfil persona; mientras que para perfil empresa se emitirá una factura.',
            ],
            [
                'question' => '¿Cuánto tiempo demora una operación interbancaria?',
                'answer' => 'El tiempo que toma una operación interbancaria es de un día útil, ya que cuando se realiza una transferencia entre bancos distintos hay una intermediación y validación de la CCE (Cámara de Compensaciones Electrónica). Es por esto que recomendamos a nuestros clientes realizar una operación interbancaria siempre y cuando no necesiten el dinero inmediatamente.',
            ],
            [
                'question' => '¿Recibo una boleta por realizar una operación en cambio seguro?',
                'answer' => 'Sí, al cabo de 24 horas realizada la operación se le mandará la boleta a su correo registrado al momento de crear su usuario, para perfil persona; mientras que para perfil empresa se emitirá una factura.',
            ],
            [
                'question' => '¿Cuánto tiempo demora una operación interbancaria?',
                'answer' => 'El tiempo que toma una operación interbancaria es de un día útil, ya que cuando se realiza una transferencia entre bancos distintos hay una intermediación y validación de la CCE (Cámara de Compensaciones Electrónica). Es por esto que recomendamos a nuestros clientes realizar una operación interbancaria siempre y cuando no necesiten el dinero inmediatamente.',
            ],
        ];

        DB::table('faqs')->insert($faqs);
    }
}
