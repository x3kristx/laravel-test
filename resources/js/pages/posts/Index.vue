<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { type BreadcrumbItem } from '@/types';
import { Head } from '@inertiajs/vue3';
import { index } from '@/routes/posts';
import { Table, TableCaption, TableBody, TableHeader, TableRow, TableCell, TableHead } from '@/components/ui/table';
import { MoreVertical } from 'lucide-vue-next';
const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Posts',
        href: index().url,
    },
];

type Post = {
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
    posts: Post[];
}>();
</script>

<template>
    <Head title="Posts" />
    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="flex h-full flex-1 flex-col gap-4 overflow-x-auto rounded-xl p-4">
            <pre>{{ posts }}</pre>
            <ul>
                <li v-for="(post, index) in posts" :key='index'>
                    {{ post.title }}
                    </li>
            </ul>
              <Table>
                <TableCaption>A list of your recent invoices.</TableCaption>
                <TableHeader>
                  <TableRow>
                    <TableHead class="w-[100px]">ID</TableHead>
                    <TableHead>Title</TableHead>
                    <TableHead>Author</TableHead>
                    <TableHead class="text-right"> Created At </TableHead>
                    <TableHead class="text-right"> Updated At </TableHead>
                    <TableHead class="text-right"> Published </TableHead>
                    <TableHead>
                        <span class ="sr-only">Actions</span>
                    </TableHead>
                  </TableRow>
                </TableHeader>
                <TableBody>
                  <TableRow v-for="post in posts" :key="post.id">
                    <TableCell class="font-medium"> {{ post.id }}</TableCell>
                    <TableCell>{{post.title}}</TableCell>
                    <TableCell>{{post.author}}</TableCell>
                    <TableCell class="text-right"> {{ post.created_at_formated }} </TableCell>
                    <TableCell class="text-right"> {{ post.updated_at_formated }} </TableCell>
                    <TableCell class="text-right"> {{ post.published}}</TableCell>
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
