<div>

    @switch($this->menu_id)
        @case('0')
            <livewire:dashboard.dashboard/>
            @break
        @case('1')
            <livewire:branches.branches />
            @break
        @case('2')
            <livewire:members.members />
            @break
        @case('3')
        <livewire:shares.shares />

            @break
        @case('4')
        <livewire:savings.savings />
            @break
        @case('5')
        <livewire:deposits.deposits />

            @break
        @case('6')
        <livewire:loans.loans />

            @break
        @case('7')
            <livewire:accounting.accounting />
            @break
        @case('8')
        <livewire:products-management.product-management />
            @break
        @case('9')
            <livewire:payments.payments />
            @break
            @case('10')
            <livewire:h-r.h-r />
            @break
            @case('11')
            <livewire:procurement.procurement />

            @break
            @case('12')
            <livewire:reconciliation.reconciliation />

            @break
            @case('13')
            <livewire:reports.reports />

            @break
            @case('14')
            <livewire:approvals.approvals-processor />
            @break
            @case('15')
            <livewire:settings.settings />

            @break
        @default
            <livewire:dashboard.dashboard/>
    @endswitch
</div>

