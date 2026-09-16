<?php

namespace Database\Seeders;

use App\Models\Company;
use App\Models\Review;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TestDataSeeder extends Seeder
{
    public function run(): void
    {
        $now = now();

        $userId_arr = [
            '11111111-1111-1111-1111-111111111111',
            '11111111-1111-1111-1111-111111111112',
            '11111111-1111-1111-1111-111111111113',
            '11111111-1111-1111-1111-111111111114',
            '11111111-1111-1111-1111-111111111115',
            '11111111-1111-1111-1111-111111111116',
        ];

        $companyId_arr = [
            '22222222-2222-2222-2222-222222222221',
            '22222222-2222-2222-2222-222222222222',
            '22222222-2222-2222-2222-222222222223',
            '22222222-2222-2222-2222-222222222224',
            '22222222-2222-2222-2222-222222222225',
            '22222222-2222-2222-2222-222222222226',
        ];

        $phones_arr =[
            '+79990000001',
            '+79990000002',
            '+79990000003',
            '+79990000004',
            '+79990000005',
            '+79990000006',
        ];

        User::query()->upsert(
            values: [
                [
                    'id' => $userId_arr[0],
                    'name' => 'Иван',
                    'surname' => 'Петров',
                    'phone' => $phones_arr[0],
                    'img_path' => null,
                    'created_at' => $now,
                    'updated_at' => $now,
                ],
                [
                    'id' => $userId_arr[1],
                    'name' => 'Мария',
                    'surname' => 'Иванова',
                    'phone' => $phones_arr[1],
                    'img_path' => null,
                    'created_at' => $now,
                    'updated_at' => $now,
                ],
                [
                    'id' => $userId_arr[2],
                    'name' => 'Алексей',
                    'surname' => 'Смирнов',
                    'phone' => $phones_arr[2],
                    'img_path' => null,
                    'created_at' => $now,
                    'updated_at' => $now,
                ],
                [
                    'id' => $userId_arr[3],
                    'name' => 'Ольга',
                    'surname' => 'Кузнецова',
                    'phone' => $phones_arr[3],
                    'img_path' => null,
                    'created_at' => $now,
                    'updated_at' => $now,
                ],
                [
                    'id' => $userId_arr[4],
                    'name' => 'Дмитрий',
                    'surname' => 'Соколов',
                    'phone' => $phones_arr[4],
                    'img_path' => null,
                    'created_at' => $now,
                    'updated_at' => $now,
                ],
                [
                    'id' => $userId_arr[5],
                    'name' => 'Олег',
                    'surname' => 'Майами',
                    'phone' => $phones_arr[5],
                    'img_path' => null,
                    'created_at' => $now,
                    'updated_at' => $now,
                ],
            ],
            uniqueBy: ['id'],
            update: ['name', 'surname', 'phone', 'img_path', 'updated_at']
        );

        Company::query()->upsert(
            values: [
                [
                    'id' => $companyId_arr[0],
                    'name' => 'Альфа',
                    'description' => 'Компания занимается разработкой цифровых продуктов для бизнеса, автоматизацией процессов и поддержкой внутренних сервисов клиентов разных отраслей.',
                    'img_path' => null,
                    'created_at' => $now,
                    'updated_at' => $now,
                ],
                [
                    'id' => $companyId_arr[1],
                    'name' => 'Бета',
                    'description' => 'Компания предоставляет услуги аналитики, интеграции данных, настройки отчетности и сопровождения информационных систем для корпоративных клиентов.',
                    'img_path' => null,
                    'created_at' => $now,
                    'updated_at' => $now,
                ],
                [
                    'id' => $companyId_arr[2],
                    'name' => 'Гамма',
                    'description' => 'Компания создает веб-сервисы, API, административные панели и инструменты для управления продажами, складом, задачами и клиентскими обращениями.',
                    'img_path' => null,
                    'created_at' => $now,
                    'updated_at' => $now,
                ],
                [
                    'id' => $companyId_arr[3],
                    'name' => 'Дельта',
                    'description' => 'Компания помогает внедрять программные решения, оптимизировать рабочие процессы, обучать сотрудников и сопровождать проекты после запуска.',
                    'img_path' => null,
                    'created_at' => $now,
                    'updated_at' => $now,
                ],
                [
                    'id' => $companyId_arr[4],
                    'name' => 'Омега',
                    'description' => 'Компания специализируется на создании надежной backend-инфраструктуры, проектировании баз данных и разработке интеграций с внешними сервисами.',
                    'img_path' => null,
                    'created_at' => $now,
                    'updated_at' => $now,
                ],
                [
                    'id' => $companyId_arr[5],
                    'name' => 'Omegalul',
                    'description' => 'ChodummmmChodummmmChodummmmChodummmmChodummmmChodummmmChodummmmChodummmmChodummmmChodummmmChodummmmChodummmmChodummmmChodummmmChodummmmChodummmm',
                    'img_path' => null,
                    'created_at' => $now,
                    'updated_at' => $now,
                ],
            ],
            uniqueBy: ['id'],
            update: ['name', 'description', 'img_path', 'updated_at']
        );


        $reviews = [];

        for ($i = 1; $i <= 10; $i++) {
            $reviews[] = [
                'id' => sprintf('33333333-3333-3333-3333-%012d', $i),
                'user_id' => $userId_arr[($i - 1) % count($userId_arr)],
                'reviewable_id' => $companyId_arr[($i - 1) % count($companyId_arr)],
                'reviewable_type' => Company::class,
                'content' => $this->reviewText($i),
                'rating' => (($i - 1) % 10) + 1,
                'created_at' => $now,
                'updated_at' => $now,
            ];
        }

        for ($i = 11; $i <= 30; $i++) {
            $authorIndex = ($i - 1) % count($userId_arr);
            $reviewedIndex = $i % count($userId_arr);

            $reviews[] = [
                'id' => sprintf('33333333-3333-3333-3333-%012d', $i),
                'user_id' => $userId_arr[$authorIndex],
                'reviewable_id' => $userId_arr[$reviewedIndex],
                'reviewable_type' => User::class,
                'content' => $this->reviewText($i),
                'rating' => (($i - 1) % 10) + 1,
                'created_at' => $now,
                'updated_at' => $now,
            ];
        }

        Review::query()->upsert(
            values: $reviews,
            uniqueBy: ['id'],
            update: [
                'user_id', 'reviewable_id', 'reviewable_type', 'content', 'rating', 'updated_at',
            ]
        );
    }

    private function reviewText(int $number): string
    {
        return "Отзыв номер {$number}. Работа выполнена внимательно и последовательно, результат соответствует ожиданиям, взаимодействие было понятным, сроки соблюдены, а итоговое качество оставило хорошее впечатление. Такой опыт можно уверенно использовать как положительный пример для дальнейшего сотрудничества.";
    }
}
