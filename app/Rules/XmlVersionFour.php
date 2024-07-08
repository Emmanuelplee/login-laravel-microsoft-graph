<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class XmlVersionFour implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        try {
            $xml = simplexml_load_file($value->getRealPath());
        } catch (\Exception $e) {
            $fail('El archivo XML no se pudo cargar correctamente.');
            return;
        }

        if ($xml === false) {
            $fail('El archivo XML no se pudo cargar correctamente.');
            return;
        }

        $namespaces = $xml->getNamespaces(true);
        $xml->registerXPathNamespace('cfdi', $namespaces['cfdi']);
        $comprobante = $xml->xpath('//cfdi:Comprobante')[0];

        $version = (string) $comprobante->attributes()->Version;
        if (!isset($version) || (string) $version !== '4.0') {
            $fail('El archivo XML debe ser de la versión 4.0.');
            return;
        }

        try {
            $xml->registerXPathNamespace('tfd', $namespaces['tfd']);
            $timbreFiscal = $xml->xpath('//tfd:TimbreFiscalDigital')[0];
            $uuid =  (string) $timbreFiscal->attributes()->UUID;
            if ($uuid === '' ) {
                $fail('El archivo XML no tiene UUID.');
                return;
            }
            //Validar el uuid con una expresión regular
            $regex = '/^[0-9a-fA-F]{8}-[0-9a-fA-F]{4}-[0-9a-fA-F]{4}-[0-9a-fA-F]{4}-[0-9a-fA-F]{12}$/';
            if (!preg_match($regex, $uuid)) {
                $fail('El uuid no es valido.');
                return;
            }

        } catch (\Exception $e) {
            $fail('No se pudo extraer la información del XML.');
        }
        // Validar otros campos o reglas específicas aquí
    }
}
