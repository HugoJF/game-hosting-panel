<x-well>
    <div class="grid grid-cols-2 gap-4">
        <div>
            <h5 class="mb-1 tracking-wide">
                <span class="inline text-gray-600" data-feather="activity"></span>
                Deploying a server
            </h5>
            <p class="text-sm text-gray-600 tracking-tight">
                Your server is currently allocated and installed in one of our nodes, meaning you can play around with any configuration file without being charged for it.
                Once you are done configuring the server and want bring it online, you are ready to deploy it!
            </p>
        </div>

        <div>
            <h5 class="mb-1 tracking-wide">
                <span class="inline text-gray-600" data-feather="settings"></span>
                Configuration
            </h5>
            <p class="text-sm text-gray-600 tracking-tight">
                Feel free to update the server resource configuration as much as necessary, as it's not fixed and can be changed between deployments.
            </p>
        </div>

        <div>
            <h5 class="mb-1 tracking-wide">
                <span class="inline text-gray-600" data-feather="credit-card"></span>
                Costs
            </h5>
            <p class="text-sm text-gray-600 tracking-tight">
                When this server is deployed, you will be immediately charged R$ {{ number_format(abs($costPerPeriod) / 100, 2) }}, which is the entire first billing period of your server.
                After this period ends, you will be automatically charged again for another period, where your server will continue to be online and running until your account runs out of funds or you decide to terminate the server.
            </p>
        </div>

        <div>
            <h5 class="mb-1 tracking-wide">
                <span class="inline text-gray-600" data-feather="power"></span>
                Termination
            </h5>
            <p class="text-sm text-gray-600 tracking-tight">
                With your server up and running, you can choose to terminate its deploy when you stop using it.
                You have an option to forcefully terminate the server, meaning it will be immediately turned off before finishing the period that has already been paid.
                Or you can request termination and the server will only be turned off after the current paid period expires.
            </p>
        </div>
    </div>
</x-well>
