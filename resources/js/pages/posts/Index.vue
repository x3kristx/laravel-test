<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { type BreadcrumbItem } from '@/types';
import { Head } from '@inertiajs/vue3';
import { index } from '@/routes/posts';
import { Table, TableCaption, TableBody, TableHeader, TableRow, TableCell, TableHead } from '@/components/ui/table';
import { MoreVertical } from 'lucide-vue-next';
import { Pagination } from 'reka-ui/namespaced';
const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Posts',
        href: index().url,
    },
];
export interface PaginationLink {
  url: string | null;
  label: string;
  page?: number | null;
  active: boolean;
}

export interface PaginatedResponse {
  current_page: number;
  data: Post[];
  first_page_url: string;
  from: number;
  last_page: number;
  last_page_url: string;
  links: PaginationLink[];
  next_page_url: string | null;
  path: string;
  per_page: number;
  prev_page_url: string | null;
  to: number;
  total: number;
}
type Post = {
  id: number;
  title: string;
  content: string;
  author: string;
  published: boolean;
  created_at: string;
  updated_at: string;
  created_at_formated: string;
  updated_at_formated: string;
};

defineProps<{
    posts: PaginatedResponse;
}>();
</script>

<template>
  <Head title="Posts" />
  <AppLayout :breadcrumbs="breadcrumbs">
    <div class="flex h-full flex-1 flex-col gap-4 overflow-x-auto rounded-xl p-4">
      <Table>
        <TableBody>
        </TableBody>
      </Table>
       <Pagination v-slot="{ page }" :total="100" :sibling-count="1" show-edges :default-page="2">
          <PaginationList v-slot="{ items }" class="flex items-center gap-1">
            <PaginationFirst />
            <PaginationPrev />
      
            <template v-for="(item, index) in items">
              <PaginationListItem v-if="item.type === 'page'" :key="index" :value="item.value" as-child>
                <Button class="w-10 h-10 p-0" :variant="item.value === page ? 'default' : 'outline'">
                  {{ item.value }}
                </Button>
              </PaginationListItem>
              <PaginationEllipsis v-else :key="item.type" :index="index" />
            </template>
      
            <PaginationNext />
            <PaginationLast />
          </PaginationList>
        </Pagination>
      <Table>
          <TableRow>
            <TableHead class="w-[100px]">ID</TableHead>
            <TableHead>Title</TableHead>
            <TableHead>Author</TableHead>
            <TableHead class="text-right">Created At</TableHead>
            <TableHead class="text-right">Updated At</TableHead>
            <TableHead class="text-right">Published</TableHead>
            <TableHead><span class="sr-only">Actions</span></TableHead>
          </TableRow>
       

        <TableBody>
          <TableRow v-for="post in posts.data" :key="post.id">
            <TableCell class="font-medium">{{ post.id }}</TableCell>
            <TableCell>{{ post.title }}</TableCell>
            <TableCell>{{ post.author }}</TableCell>
            <TableCell class="text-right">{{ post.created_at_formated }}</TableCell>
            <TableCell class="text-right">{{ post.updated_at_formated }}</TableCell>
            <TableCell class="text-right">{{ post.published }}</TableCell>
            <TableCell>
              <div class="flex justify-end">
                <DropdownMenu>
                  <DropdownMenuTrigger as-child>
                    <Button size="icon" variant="ghost">
                      <MoreVertical />
                    </Button>
                  </DropdownMenuTrigger>
                  <DropdownMenuContent>
                    <DropdownMenuItem>View</DropdownMenuItem>
                    <DropdownMenuItem>Edit</DropdownMenuItem>
                    <DropdownMenuSeparator />
                    <DropdownMenuItem class="text-destructive">Delete</DropdownMenuItem>
                  </DropdownMenuContent>
                </DropdownMenu>
              </div>
            </TableCell>
          </TableRow>
        </TableBody>
      </Table>
    </div>
  </AppLayout>
</template>
