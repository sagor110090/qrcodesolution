<div class="border-neutral-100 px-6 py-4 dark:border-neutral-500" x-show="type === 'vcard'">
    <h5 class="flex items-center justify-center text-neutral-500 dark:text-neutral-300">
        <x-tw.label class="mr-2 font-bold text-md">
            Vcard QR Code
        </x-tw.label>
    </h5>
    <div class="mt-2 text-sm  text-neutral-500 dark:text-neutral-300 text-weight-300">

        <div class="grid grid-cols-2 gap-4">
            <x-tw.input label="First Name" placeholder="First Name" id="first_name"  type="text" required/>
            <x-tw.input label="Last Name" placeholder="Last Name" id="last_name"   type="text" required/>
            <x-tw.input label="Phone Number" placeholder="Phone Number" id="phone_number"   type="text" required/>
            <x-tw.input label="Mobile" placeholder="Mobile" id="mobile"   type="text" required/>
            <x-tw.input label="Email" placeholder="Email" id="email"   type="email" required/>
            <x-tw.input label="Website (URL)" placeholder="Website (URL)" id="website"   type="link" />
            <x-tw.input label="Company" placeholder="Company" id="company"   type="text" />
            <x-tw.input label="Job Title" placeholder="Job Title" id="job_title"   type="text" />
            <x-tw.textarea label="Address" placeholder="Address" id="address"  required class="col-span-2" />
            <x-tw.input label="Fax" placeholder="Fax" id="fax"   type="text" />
            <x-tw.input label="City" placeholder="City" id="city"   type="text" />
            <x-tw.input label="Post Code" placeholder="Post Code" id="post_code"   type="text" />
            <x-tw.input label="Country" placeholder="Country" id="country"   type="text" required/>

        </div>

    </div>

</div>
