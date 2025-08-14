@pushOnce('scripts')
    <script
        type="text/x-template"
        id="v-checkout-address-form-template"
    >
        <div class="mt-2 max-md:mt-3">
            <x-shop::form.control-group class="hidden">
                <x-shop::form.control-group.control
                    type="text"
                    ::name="controlName + '.id'"
                    ::value="address.id"
                />
            </x-shop::form.control-group>

            <!-- Company Name -->
            <x-shop::form.control-group>
                <x-shop::form.control-group.label>
                    @lang('shop::app.checkout.onepage.address.company-name')
                </x-shop::form.control-group.label>

                <x-shop::form.control-group.control
                    type="text"
                    ::name="controlName + '.company_name'"
                    ::value="address.company_name"
                    :placeholder="trans('shop::app.checkout.onepage.address.company-name')"
                />
            </x-shop::form.control-group>

            {!! view_render_event('bagisto.shop.checkout.onepage.address.form.company_name.after') !!}

            <!-- First Name -->
            <div class="grid grid-cols-2 gap-x-5 max-md:grid-cols-1">
                <x-shop::form.control-group>
                    <x-shop::form.control-group.label class="required !mt-0">
                        @lang('shop::app.checkout.onepage.address.first-name')
                    </x-shop::form.control-group.label>

                    <x-shop::form.control-group.control
                        type="text"
                        ::name="controlName + '.first_name'"
                        ::value="address.first_name"
                        rules="required"
                        :label="trans('shop::app.checkout.onepage.address.first-name')"
                        :placeholder="trans('shop::app.checkout.onepage.address.first-name')"
                    />

                    <x-shop::form.control-group.error ::name="controlName + '.first_name'" />
                </x-shop::form.control-group>

                {!! view_render_event('bagisto.shop.checkout.onepage.address.form.first_name.after') !!}

                <!-- Last Name -->
                <x-shop::form.control-group>
                    <x-shop::form.control-group.label class="required !mt-0">
                        @lang('shop::app.checkout.onepage.address.last-name')
                    </x-shop::form.control-group.label>

                    <x-shop::form.control-group.control
                        type="text"
                        ::name="controlName + '.last_name'"
                        ::value="address.last_name"
                        rules="required"
                        :label="trans('shop::app.checkout.onepage.address.last-name')"
                        :placeholder="trans('shop::app.checkout.onepage.address.last-name')"
                    />

                    <x-shop::form.control-group.error ::name="controlName + '.last_name'" />
                </x-shop::form.control-group>

                {!! view_render_event('bagisto.shop.checkout.onepage.address.form.last_name.after') !!}
            </div>

            <!-- Email -->
            <x-shop::form.control-group>
                <x-shop::form.control-group.label class="required !mt-0">
                    @lang('shop::app.checkout.onepage.address.email')
                </x-shop::form.control-group.label>

                <x-shop::form.control-group.control
                    type="email"
                    ::name="controlName + '.email'"
                    ::value="address.email"
                    rules="required|email"
                    :label="trans('shop::app.checkout.onepage.address.email')"
                    placeholder="email@example.com"
                />

                <x-shop::form.control-group.error ::name="controlName + '.email'" />
            </x-shop::form.control-group>

            {!! view_render_event('bagisto.shop.checkout.onepage.address.form.email.after') !!}

            <!-- Street Address -->
            <x-shop::form.control-group>
                <x-shop::form.control-group.label class="required !mt-0">
                    @lang('shop::app.checkout.onepage.address.street-address')
                </x-shop::form.control-group.label>

                <x-shop::form.control-group.control
                    type="text"
                    ::name="controlName + '.address.[0]'"
                    ::value="address.address[0]"
                    rules="required"
                    :label="trans('shop::app.checkout.onepage.address.street-address')"
                    :placeholder="trans('shop::app.checkout.onepage.address.street-address')"
                />

                <x-shop::form.control-group.error
                    class="mb-2"
                    ::name="controlName + '.address.[0]'"
                />

                @if (core()->getConfigData('customer.address.information.street_lines') > 1)
                    @for ($i = 1; $i < core()->getConfigData('customer.address.information.street_lines'); $i++)
                        <x-shop::form.control-group.control
                            type="text"
                            ::name="controlName + '.address.[{{ $i }}]'"
                            rules="address"
                            :label="trans('shop::app.checkout.onepage.address.street-address')"
                            :placeholder="trans('shop::app.checkout.onepage.address.street-address')"
                        />

                        <x-shop::form.control-group.error
                            class="mb-2"
                            ::name="controlName + '.address.[{{ $i }}]'"
                        />
                    @endfor
                @endif
            </x-shop::form.control-group>

            {!! view_render_event('bagisto.shop.checkout.onepage.address.form.address.after') !!}

            <div class="grid grid-cols-2 gap-x-5 max-md:grid-cols-1">

 <!-- Country -->
<x-shop::form.control-group class="!mb-4">
    <x-shop::form.control-group.label class="{{ core()->isCountryRequired() ? 'required' : '' }} !mt-0">
        @lang('shop::app.checkout.onepage.address.country')
    </x-shop::form.control-group.label>

    <!-- Si el país es CO, muestra solo Colombia -->
    <template v-if="selectedCountry === 'CO' || address.country === 'CO'">
        <x-shop::form.control-group.control
            type="select"
            ::name="controlName + '.country'"
            v-model="selectedCountry"
            rules="{{ core()->isCountryRequired() ? 'required' : '' }}"
            :label="trans('shop::app.checkout.onepage.address.country')"
        >
            <option value="CO">Colombia</option>
        </x-shop::form.control-group.control>
    </template>

    <!-- Para otros países, lista completa -->
    <template v-else>
        <x-shop::form.control-group.control
            type="select"
            ::name="controlName + '.country'"
            ::value="address.country"
            v-model="selectedCountry"
            rules="{{ core()->isCountryRequired() ? 'required' : '' }}"
            :label="trans('shop::app.checkout.onepage.address.country')"
            :placeholder="trans('shop::app.checkout.onepage.address.country')"
        >
            <option value="">
                @lang('shop::app.checkout.onepage.address.select-country')
            </option>

            <option
                v-for="country in countries"
                :value="country.code"
            >
                @{{ country.name }}
            </option>
        </x-shop::form.control-group.control>
    </template>

    <x-shop::form.control-group.error ::name="controlName + '.country'" />
</x-shop::form.control-group>

{!! view_render_event('bagisto.shop.checkout.onepage.address.form.country.after') !!}


<!-- State -->
<x-shop::form.control-group class="!mb-4">
    <x-shop::form.control-group.label class="{{ core()->isStateRequired() ? 'required' : '' }}">
        @lang('shop::app.checkout.onepage.address.state')
    </x-shop::form.control-group.label>

    <!-- Si el país es Colombia -->
    <template v-if="selectedCountry === 'CO'">
        <x-shop::form.control-group.control
            type="select"
            ::name="controlName + '.state'"
            v-model="address.state"
            rules="{{ core()->isStateRequired() ? 'required' : '' }}"
            @change="updateCities"
            :label="trans('shop::app.checkout.onepage.address.state')"
        >
            <option value="">
                @lang('shop::app.checkout.onepage.address.select-state')
            </option>

            <option
                v-for="(ciudades, departamento) in departamentos"
                :value="departamento"
            >
                @{{ departamento }}
            </option>
        </x-shop::form.control-group.control>
    </template>

    <!-- Si no es Colombia y sí hay estados cargados por defecto -->
    <template v-else-if="haveStates">
        <x-shop::form.control-group.control
            type="select"
            ::name="controlName + '.state'"
            v-model="address.state"
            rules="{{ core()->isStateRequired() ? 'required' : '' }}"
            :label="trans('shop::app.checkout.onepage.address.state')"
        >
            <option
                v-for="state in countryStates[selectedCountry]"
                :value="state.code"
            >
                @{{ state.default_name }}
            </option>
        </x-shop::form.control-group.control>
    </template>

    <!-- Si no hay estados disponibles -->
    <template v-else>
        <x-shop::form.control-group.control
            type="text"
            ::name="controlName + '.state'"
            v-model="address.state"
            rules="{{ core()->isStateRequired() ? 'required' : '' }}"
            :label="trans('shop::app.checkout.onepage.address.state')"
            :placeholder="trans('shop::app.checkout.onepage.address.state')"
        />
    </template>

    <x-shop::form.control-group.error ::name="controlName + '.state'" />
</x-shop::form.control-group>

{!! view_render_event('bagisto.shop.checkout.onepage.address.form.state.after') !!}



            </div>

            <div class="grid grid-cols-2 gap-x-5 max-md:grid-cols-1">
 
<!-- City -->
<x-shop::form.control-group>
    <x-shop::form.control-group.label class="required !mt-0">
        @lang('shop::app.checkout.onepage.address.city')
    </x-shop::form.control-group.label>

    <template v-if="selectedCountry === 'CO'">
        <x-shop::form.control-group.control
            type="select"
            ::name="controlName + '.city'"
            v-model="address.city"
            rules="required"
            @change="updateDaneCode"
            :label="trans('shop::app.checkout.onepage.address.city')"
        >
            <option value="">
                @lang('shop::app.checkout.onepage.address.select-city')
            </option>

            <option
                v-for="ciudad in ciudadesDisponibles"
                :value="ciudad.name"
            >
                @{{ ciudad.name }}
            </option>
        </x-shop::form.control-group.control>
    </template>

    <template v-else>
        <x-shop::form.control-group.control
            type="text"
            ::name="controlName + '.city'"
            v-model="address.city"
            rules="required"
            :label="trans('shop::app.checkout.onepage.address.city')"
            :placeholder="trans('shop::app.checkout.onepage.address.city')"
        />
    </template>

    <x-shop::form.control-group.error ::name="controlName + '.city'" />
</x-shop::form.control-group>

                {!! view_render_event('bagisto.shop.checkout.onepage.address.form.city.after') !!}

<!-- Postcode (DANE) - oculto -->
<x-shop::form.control-group.control
    type="hidden"
    ::name="controlName + '.postcode'"
    v-model="address.postcode"
/>

                {!! view_render_event('bagisto.shop.checkout.onepage.address.form.postcode.after') !!}
            </div>

            <!-- Phone Number -->
            <x-shop::form.control-group>
                <x-shop::form.control-group.label class="required !mt-0">
                    @lang('shop::app.checkout.onepage.address.telephone')
                </x-shop::form.control-group.label>

                <x-shop::form.control-group.control
                    type="text"
                    ::name="controlName + '.phone'"
                    ::value="address.phone"
                    rules="required|numeric"
                    :label="trans('shop::app.checkout.onepage.address.telephone')"
                    :placeholder="trans('shop::app.checkout.onepage.address.telephone')"
                />

                <x-shop::form.control-group.error ::name="controlName + '.phone'" />
            </x-shop::form.control-group>

            {!! view_render_event('bagisto.shop.checkout.onepage.address.form.phone.after') !!}
        </div>
    </script>

<script type="module">
    app.component('v-checkout-address-form', {
        template: '#v-checkout-address-form-template',

        props: {
            controlName: {
                type: String,
                required: true,
            },

            address: {
                type: Object,
                default: () => ({
                    id: 0,
                    company_name: '',
                    first_name: '',
                    last_name: '',
                    email: '',
                    address: [],
                    country: '',
                    state: '',
                    city: '',
                    postcode: '',
                    phone: '',
                }),
            },
        },

        data() {
            return {
                countries: [],
                countryStates: {},

                selectedCountry: this.address.country,

                departamentos: {},
                ciudadesDisponibles: [],
                daneCode: null,
            };
        },

        computed: {
            haveStates() {
                return !!this.countryStates[this.address.country]?.length;
            },
        },

mounted() {
    this.getCountries();
    this.getStates();

    fetch('/data/departamentos_colombia.json')
        .then(response => response.json())
        .then(data => {
            this.departamentos = data;

            if (this.address.country === 'CO' && this.address.state) {
                this.updateCities();
            }

            if (
                this.address.country === 'CO' &&
                this.address.state &&
                this.address.city
            ) {
                this.updateDaneCode();
            }
        });
},

        methods: {
            getCountries() {
                this.$axios.get("{{ route('shop.api.core.countries') }}")
                    .then(response => {
                        this.countries = response.data.data;
                    });
            },

            getStates() {
                this.$axios.get("{{ route('shop.api.core.states') }}")
                    .then(response => {
                        this.countryStates = response.data.data;
                    });
            },

            updateCities() {
                const departamento = this.address.state;
                this.ciudadesDisponibles = this.departamentos[departamento] || [];

                //this.address.city = '';
                this.daneCode = null;
                this.address.postcode = '';
            },

            updateDaneCode() {
                const ciudadSeleccionada = this.ciudadesDisponibles.find(
                    c => c.name === this.address.city
                );

                this.daneCode = ciudadSeleccionada ? ciudadSeleccionada.dane : null;
                this.address.postcode = this.daneCode ?? '';
            }
        },

        watch: {
            selectedCountry(newVal) {
                this.address.country = newVal;

                if (newVal === 'CO' && this.address.state) {
                    this.updateCities();
                }
            },

            'address.state': function () {
                if (this.address.country === 'CO') {
                    this.updateCities();
                }
            },

            'address.city': function () {
                if (this.address.country === 'CO') {
                    this.updateDaneCode();
                }
            }
        }
    });
</script>
@endPushOnce