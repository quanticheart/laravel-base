<?php
    
    namespace App\Providers;
    
    use App\Rules\Celular;
    use App\Rules\CelularComCodigo;
    use App\Rules\CelularComDdd;
    use App\Rules\Cnh;
    use App\Rules\Cnpj;
    use App\Rules\Cpf;
    use App\Rules\FormatoCep;
    use App\Rules\FormatoCnpj;
    use App\Rules\FormatoCpf;
    use App\Rules\FormatoPis;
    use App\Rules\FormatoPlacaDeVeiculo;
    use App\Rules\Pis;
    use App\Rules\Telefone;
    use App\Rules\TelefoneComCodigo;
    use App\Rules\TelefoneComDdd;
    use Illuminate\Support\ServiceProvider;

    /**
     * Class ValidatorProvider
     * @package App\Providers
     *
     * celular - Valida se o campo está no formato (99999-9999 ou 9999-9999)
     *
     * celular_com_ddd - Valida se o campo está no formato ((99)99999-9999 ou (99)9999-9999 ou (99) 99999-9999 ou (99) 9999-9999)
     *
     * celular_com_codigo - Valida se o campo está no formato +99(99)99999-9999 ou +99(99)9999-9999.
     *
     * cnpj - Valida se o campo é um CNPJ válido. É possível gerar um CNPJ válido para seus testes utilizando o site geradorcnpj.com
     *
     * cpf - Valida se o campo é um CPF válido. É possível gerar um CPF válido para seus testes utilizando o site geradordecpf.org
     *
     * data - Valida se o campo é uma data no formato DD/MM/YYYY. Por exemplo: 31/12/1969. - Removido na versão 8.0 >=. Utilize opcionalmente dateformat:d/m/Y no Laravel.
     *
     * formato_cnpj - Valida se o campo tem uma máscara de CNPJ correta (99.999.999/9999-99).
     *
     * formato_cpf - Valida se o campo tem uma máscara de CPF correta (999.999.999-99).
     *
     * formato_cep - Valida se o campo tem uma máscara de correta (99999-999 ou 99.999-999).
     *
     * telefone - Valida se o campo tem umas máscara de telefone (9999-9999).
     *
     * telefone_com_ddd - Valida se o campo tem umas máscara de telefone com DDD ((99)9999-9999).
     *
     * telefone_com_codigo - Valida se o campo tem umas máscara de telefone com DDD (+55(99)9999-9999).
     *
     * formato_placa_de_veiculo - Valida se o campo tem o formato válido de uma placa de veículo (incluindo o padrão MERCOSUL).
     *
     * formato_pis - Valida se o campo tem o formato de PIS.
     *
     * pis - Valida se o PIS é válido.
     */
    class ValidatorProvider extends ServiceProvider
    {
        
        /**
         * Indicates if loading of the provider is deferred.
         *
         * @var bool
         */
        protected $defer = false;
        
        
        /**
         * Bootstrap the application events.
         *
         * @return void
         */
        
        public function boot()
        {
            
            $rules = [
                'celular' => Celular::class,
                'celular_com_ddd' => CelularComDdd::class,
                'celular_com_codigo' => CelularComCodigo::class,
                'cnh' => Cnh::class,
                'cnpj' => Cnpj::class,
                'cpf' => Cpf::class,
                'formato_cnpj' => FormatoCnpj::class,
                'formato_cpf' => FormatoCpf::class,
                'telefone' => Telefone::class,
                'telefone_com_ddd' => TelefoneComDdd::class,
                'telefone_com_codigo' => TelefoneComCodigo::class,
                'formato_cep' => FormatoCep::class,
                'formato_placa_de_veiculo' => FormatoPlacaDeVeiculo::class,
                'formato_pis' => FormatoPis::class,
                'pis' => Pis::class,
            ];
            
            foreach ($rules as $name => $class) {
                
                $rule = new $class;
                
                $extension = static function ($attribute, $value) use ($rule) {
                    return $rule->passes($attribute, $value);
                };
                
                $this->app['validator']->extend($name, $extension, $rule->message());
            }
        }
        
        
        /**
         * Register the service provider.
         *
         * @return void
         */
        public function register()
        {
        
        }
        
        /**
         * Get the services provided by the provider.
         *
         * @return array
         */
        public function provides()
        {
            return [];
        }
        
    }
