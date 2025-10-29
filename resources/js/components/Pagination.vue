<template>
    <Pagination v-slot="{ page }" v-model:page="currentPage" :default-page="currentPage"
                :total="parseInt(total)*10"
                class="flex justify-start" show-edges>
        <PaginationList v-slot="{ items }" class="flex items-center gap-1">
            <PaginationFirst class="rotate-180 transform w-8 h-8 p-0"/>

            <template v-for="(item, index) in items">
                <PaginationListItem v-if="item.type === 'page'" :key="index" :value="item.value" as-child>
                    <Button :variant="item.value === page ? 'default' : 'outline'" class="w-8 h-8 p-0">
                        {{ item.value }}
                    </Button>
                </PaginationListItem>
                <PaginationEllipsis v-else :key="item.type" :index="index"/>
            </template>

            <PaginationLast class="rotate-180 transform w-8 h-8 p-0"/>
        </PaginationList>
    </Pagination>
</template>
<script setup>
import {
    Button,
} from '@/components/ui/button'

import {
    Pagination,
    PaginationEllipsis,
    PaginationFirst,
    PaginationLast,
    PaginationList,
    PaginationListItem,
} from '@/components/ui/pagination'

const props = defineProps({

    total: {
        type: Number,
        required: true,
    },
})

const currentPage = defineModel({
    type: Number,
    required: true,
});

</script>
