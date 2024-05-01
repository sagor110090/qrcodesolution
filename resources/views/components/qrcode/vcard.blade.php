@props([
    'vcard_first_name' => '',
    'vcard_last_name' => '',
    'vcard_phone_number' => '',
    'vcard_mobile' => '',
    'vcard_email' => '',
    'vcard_website' => '',
    'vcard_company' => '',
    'vcard_job_title' => '',
    'vcard_address' => '',
    'vcard_fax' => '',
    'vcard_city' => '',
    'vcard_post_code' => '',
    'vcard_country' => '',

])

<div class="px-6 py-4 border-neutral-100 dark:border-neutral-500" x-show="type === 'vcard'" x-data x-cloak>
    <h5 class="flex items-center justify-center text-neutral-500 dark:text-neutral-300">
        <x-tw.label class="mr-2 font-bold text-md">
            Vcard QR Code
        </x-tw.label>
    </h5>
    <div class="mt-2 text-sm text-neutral-500 dark:text-neutral-300 text-weight-300">

        <div class="grid grid-cols-2 gap-4">
            <x-tw.input label="First Name" placeholder="First Name" id="first_name"  type="text" name="vcard_first_name" value="{{ $vcard_first_name }}"/>
            <x-tw.input label="Last Name" placeholder="Last Name" id="last_name"   type="text" name="vcard_last_name" value="{{ $vcard_last_name }}"/>
            <x-tw.input label="Phone Number" placeholder="Phone Number" id="phone_number"   type="text" name="vcard_phone_number" value="{{ $vcard_phone_number }}"/>
            <x-tw.input label="Mobile" placeholder="Mobile" id="mobile"   type="text" name="vcard_mobile" value="{{ $vcard_mobile }}"/>
            <x-tw.input label="Email" placeholder="Email" id="email"   type="email" name="vcard_email" value="{{ $vcard_email }}"/>
            <x-tw.input label="Website (URL)" placeholder="Website (URL)" id="website"   type="link" name="vcard_website" value="{{ $vcard_website }}"/>
            <x-tw.input label="Company" placeholder="Company" id="company"   type="text" name="vcard_company" value="{{ $vcard_company }}"/>
            <x-tw.input label="Job Title" placeholder="Job Title" id="job_title"   type="text" name="vcard_job_title" value="{{ $vcard_job_title }}"/>
            <x-tw.textarea label="Address" placeholder="Address" id="address"   class="col-span-2" name="vcard_address" value="{{ $vcard_address }}"/>
            <x-tw.input label="Fax" placeholder="Fax" id="fax"   type="text" name="vcard_fax" value="{{ $vcard_fax }}"/>
            <x-tw.input label="City" placeholder="City" id="city"   type="text" name="vcard_city" value="{{ $vcard_city }}"/>
            <x-tw.input label="Post Code" placeholder="Post Code" id="post_code"   type="text" name="vcard_post_code" value="{{ $vcard_post_code }}"/>
            <x-tw.input label="Country" placeholder="Country" id="country"   type="text" name="vcard_country" value="{{ $vcard_country }}"/>

        </div>

    </div>

</div>
