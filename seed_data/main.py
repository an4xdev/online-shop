from typing import List, Literal, LiteralString, Tuple
from data import products
from data import lorem
import random
from datetime import datetime, timedelta

PROBALITY_MIN: int = 1
PROBALITY_MAX: int = 10
PROBALITY: int = 7
SELLER_ID_START: int = 2
SELLER_ID_END: int = 7
USER_ID_START: int = 8
USER_ID_END: int = 13
PURCHASE_PER_USER: int = 4
PURCHASE_BY_SELLER: int = 2
PURCHASE_MIN_ITEMS: int = 1
PURCHASE_MAX_ITEMS: int = 3
PURCHASE_ITEM_COUNTER_MIN: int = 1
PURCHASE_ITEM_COUNTER_MAX: int = 3
PICTURE: str = "https://picsum.photos/200"
PRODUCTS_IN_SHOP_MIN: int = 10
PRODUCTS_IN_SHOP_MAX: int = 50
PRODUCT_PRICE_MIN: int = 10
PRODUCT_PRICE_MAX: int = 100
FLOATING_1: float = .49
FLOATING_2: float = .99
DAYS_BACK_MIN: int = 1
DAYS_BACK_MAX: int = 30
PRODUCT_COUNT_LIST = [1, 2, 5, 10]
DELIVERY_STATUS_ID_START: int = 1
DELIVERY_STATUS_ID_END: int = 4
DELIVERY_METHOD_ID_START: int = 1
DELIVERY_METHOD_ID_END: int = 3
OPINIONS_BY_PRODUCT: int = 2
STARS_MIN: int = 1
STARS_MAX: int = 5
OPINION_NULL_PROBALITY_MIN: int = 1
OPINION_NULL_PROBALITY_MAX: int = 10
OPINION_NULL_PROBALITY: int = 3
WORDS_IN_OPINION_DESCRIPTION_MIN: int = 5
WORDS_IN_OPINION_DESCRIPTION_MAX: int = 50
MESSAGES_BY_PURCHASE_BY_SELLER: int = 4

if __name__ == "__main__":

    assert PROBALITY_MAX > PROBALITY_MIN, "Max probality must be greater than min probality"
    assert PROBALITY_MAX > PROBALITY and PROBALITY > PROBALITY_MIN, "Probality must be between max and min"
    assert SELLER_ID_START < SELLER_ID_END, "Seller end id must be greater than start id"
    assert USER_ID_START < USER_ID_END, "User end id must be greater than start id"
    assert PURCHASE_ITEM_COUNTER_MIN < PURCHASE_ITEM_COUNTER_MAX, "Purchase max item count must be greater than min product counter"
    assert PRODUCTS_IN_SHOP_MIN < PRODUCTS_IN_SHOP_MAX, "Max items in shop must be greater than min products in shop"
    assert DAYS_BACK_MIN < DAYS_BACK_MAX, "Max day back must be greater than min day back"
    assert DELIVERY_STATUS_ID_START < DELIVERY_STATUS_ID_END, "Delivery status id end must be greater than delivery status id start"
    assert DELIVERY_METHOD_ID_START < DELIVERY_METHOD_ID_END, "Delivery method id end must be greater than delivery method id start"
    assert STARS_MIN < STARS_MAX, "Stars for product opinion max must be grather than start for product opinion min"
    assert STARS_MIN >= 1, "In implemenatation min stars is 1, see Opinions model"
    assert STARS_MAX <= 5, "In implemenatation msx stars is 5, see Opinions model"
    assert OPINION_NULL_PROBALITY_MAX > OPINION_NULL_PROBALITY_MIN, "Max probality of null description for opinion of product must be greater than min probality of null description for opinion of product"
    assert OPINION_NULL_PROBALITY_MAX > OPINION_NULL_PROBALITY and OPINION_NULL_PROBALITY > OPINION_NULL_PROBALITY_MIN, "Probality of null description for opinion of product must be between max and min"
    assert WORDS_IN_OPINION_DESCRIPTION_MAX > WORDS_IN_OPINION_DESCRIPTION_MIN, "words in opinion description max must be greater than words in opinion description min"
    lorem_splited: List[LiteralString] = lorem.split(" ")
    assert len(
        lorem_splited) > WORDS_IN_OPINION_DESCRIPTION_MAX, "words in opinion description must be less than len of lorem splitted by \" \""

    assert MESSAGES_BY_PURCHASE_BY_SELLER % 2 == 0, "Messages count must be even (user and seller sends messages and responses)"
    current_datetime: datetime = datetime.now()

    formatted_datetime: str = current_datetime.strftime('%Y-%m-%d %H:%M:%S')

    with open("data.sql", "w", encoding="utf-8") as file:
        sql: str = "BEGIN TRANSACTION;\n"
        sub_cat_id: int = 1
        cat_id: int = 1
        price_and_seller: List[Tuple[float, int, int]] = []
        price_and_seller.append((0.0, 0, 0))
        product_id: int = 1
        for category_dict in products:
            for category_name, items_dict in category_dict.items():
                sql += f"INSERT INTO categories('id', 'name', 'created_at', 'updated_at') VALUES ({
                    cat_id}, '{category_name}', '{formatted_datetime}', '{formatted_datetime}');\n"
                for sub_category, item_data in items_dict.items():
                    sql += f"INSERT INTO sub_categories('id', 'name', 'category_id','created_at', 'updated_at') VALUEs ({
                        sub_cat_id}, '{sub_category}', {cat_id},'{formatted_datetime}', '{formatted_datetime}');\n"
                    for company in item_data[2]:
                        if item_data[1] != "sztuka":
                            for count in PRODUCT_COUNT_LIST:
                                price: float = random.randint(
                                    PRODUCT_PRICE_MIN, PRODUCT_PRICE_MAX)
                                if random.randint(PROBALITY_MIN, PROBALITY_MAX) > PROBALITY:
                                    price += FLOATING_1
                                else:
                                    price += FLOATING_2
                                counter: int = random.randint(
                                    PRODUCTS_IN_SHOP_MIN, PRODUCTS_IN_SHOP_MAX)
                                seller_id: int = random.randint(
                                    SELLER_ID_START, SELLER_ID_END)
                                product_name: str = f"{item_data[0]} {
                                    company} {count} {item_data[1]}"
                                sql += f"INSERT INTO products('id','name', 'description','price', 'image_path', 'counter', 'sub_category_id', 'seller_id', 'created_at', 'updated_at') VALUES ({product_id},'{
                                    product_name}', '{lorem}', {price}, '{PICTURE}', {counter}, {sub_cat_id}, {seller_id}, '{formatted_datetime}', '{formatted_datetime}');\n"

                                for _ in range(OPINIONS_BY_PRODUCT):
                                    user_id = random.randint(
                                        USER_ID_START, USER_ID_END)
                                    description: LiteralString | None = None
                                    if random.randint(OPINION_NULL_PROBALITY_MIN, OPINION_NULL_PROBALITY_MAX) > OPINION_NULL_PROBALITY:
                                        description = ' '.join(random.sample(lorem_splited, k=random.randint(
                                            WORDS_IN_OPINION_DESCRIPTION_MIN, WORDS_IN_OPINION_DESCRIPTION_MAX)))
                                    stars: int = random.randint(
                                        STARS_MIN, STARS_MAX)
                                    sql += f"INSERT INTO opinions('id', 'product_id', 'user_id', 'stars', 'description', 'created_at', 'updated_at') VALUES (NULL, {
                                        product_id}, {user_id}, {stars}, "
                                    if description is not None:
                                        sql += f"'{description}'"
                                    else:
                                        sql += "NULL"
                                    sql += f",'{formatted_datetime}', '{
                                        formatted_datetime}');\n"

                                product_id += 1
                                price_and_seller.append(
                                    (price, product_id, seller_id))
                        else:
                            price = random.randint(
                                PRODUCT_PRICE_MIN, PRODUCT_PRICE_MAX)
                            if random.randint(1, 10) > PROBALITY:
                                price += FLOATING_1
                            else:
                                price += FLOATING_2
                            counter = random.randint(
                                PRODUCTS_IN_SHOP_MIN, PRODUCTS_IN_SHOP_MAX)
                            seller_id = random.randint(
                                SELLER_ID_START, SELLER_ID_END)
                            product_name = f"{item_data[0]} {
                                company} {count} {item_data[1]}"
                            sql += f"INSERT INTO products('id','name', 'description','price', 'image_path', 'counter', 'sub_category_id', 'seller_id', 'created_at', 'updated_at') VALUES ({product_id},'{
                                product_name}', '{lorem}', {price}, '{PICTURE}', {counter}, {sub_cat_id}, {seller_id}, '{formatted_datetime}', '{formatted_datetime}');\n"

                            for _ in range(OPINIONS_BY_PRODUCT):
                                user_id = random.randint(
                                    USER_ID_START, USER_ID_END)
                                description: LiteralString | None = None
                                if random.randint(OPINION_NULL_PROBALITY_MIN, OPINION_NULL_PROBALITY_MAX) > OPINION_NULL_PROBALITY:
                                    description = ' '.join(random.sample(lorem_splited, k=random.randint(
                                        WORDS_IN_OPINION_DESCRIPTION_MIN, WORDS_IN_OPINION_DESCRIPTION_MAX)))
                                stars = random.randint(
                                    STARS_MIN, STARS_MAX)
                                sql += f"INSERT INTO opinions('id', 'product_id', 'user_id', 'stars', 'description', 'created_at', 'updated_at') VALUES (NULL, {
                                    product_id}, {user_id}, {stars}, "
                                if description is not None:
                                    sql += f"'{description}'"
                                else:
                                    sql += "NULL"
                                sql += f",'{formatted_datetime}', '{formatted_datetime}');\n"
                            product_id += 1
                            price_and_seller.append(
                                (price, product_id, seller_id))
                    sub_cat_id += 1
                cat_id += 1
        purchase_id: int = 1
        purchase_by_seller_id: int = 1
        for user_id in range(USER_ID_START, USER_ID_END+1):
            for _ in range(PURCHASE_PER_USER):
                days_back: int = random.randint(DAYS_BACK_MIN, DAYS_BACK_MAX)
                earlier_date: datetime = datetime.now() - timedelta(days=days_back)
                cudate: str = earlier_date.strftime('%Y-%m-%d %H:%M:%S')
                purchase_date: str = earlier_date.strftime('%Y-%m-%d')

                sql += f"INSERT INTO purchases('id', 'date', 'user_id', 'total_price', 'created_at', 'updated_at') VALUES({
                    purchase_id}, '{purchase_date}', {user_id}, 1.1, '{cudate}', '{cudate}');\n"

                sellers: List[int] = []
                total_price: float = 0.0
                for _ in range(PURCHASE_BY_SELLER):
                    seller: int = random.randint(
                        SELLER_ID_START, SELLER_ID_END)
                    while seller in sellers:
                        seller = random.randint(
                            SELLER_ID_START, SELLER_ID_END)
                    sellers.append(seller)

                    items: List[Tuple[float, int]] = list(map(lambda it: (it[0], it[1]), filter(
                        lambda ps: (ps[2] == seller), price_and_seller)))

                    count_items_in_purchase = random.randint(
                        PURCHASE_MIN_ITEMS, PURCHASE_MAX_ITEMS)

                    delivery_status = random.randint(
                    DELIVERY_STATUS_ID_START, DELIVERY_STATUS_ID_END)

                    delivered = True if delivery_status == DELIVERY_STATUS_ID_END else False

                    delivery_method = random.randint(
                    DELIVERY_METHOD_ID_START, DELIVERY_METHOD_ID_END)

                    sql += f"INSERT INTO purchase_by_sellers('id', 'purchase_id', 'delivery_status_id', 'delivery_method_id', 'delivered', 'seller_id', 'created_at', 'updated_at') VALUES({
                        purchase_by_seller_id}, {purchase_id}, {delivery_status}, {delivery_method}, {1 if delivered else 0}, {seller}, '{cudate}', '{cudate}');\n"

                    items_in_purchase: List[Tuple[float, int]] = []

                    for _ in range(count_items_in_purchase):

                        random_item: Tuple[float, int] = items[random.randint(
                            0, len(items) - 1)]

                        while random_item in items_in_purchase:
                            random_item = items[random.randint(
                                0, len(items) - 1)]

                        items_in_purchase.append(random_item)

                        counter = random.randint(
                        PURCHASE_ITEM_COUNTER_MIN, PURCHASE_ITEM_COUNTER_MAX)

                        total_price += counter * random_item[0]

                        sql += f"INSERT INTO purchase_products('id', 'purchase_by_seller_id', 'product_id', 'counter', 'created_at', 'updated_at') VALUES (NULL, {
                            purchase_by_seller_id}, {random_item[1]}, {counter}, '{cudate}', '{cudate}');\n"

                    for m in range(MESSAGES_BY_PURCHASE_BY_SELLER):
                        text = ' '.join(random.sample(lorem_splited, k=random.randint(
                            WORDS_IN_OPINION_DESCRIPTION_MIN, WORDS_IN_OPINION_DESCRIPTION_MAX)))
                        sql += f"INSERT INTO messages ('id', 'text', 'purchase_by_seller_id', 'sender_id', 'created_at', 'updated_at') VALUES(NULL, '{
                            text}', {purchase_by_seller_id}, "
                        if m % 2 == 0:
                            sql += f"{seller}, "
                        else:
                            sql += f"{user_id}, "
                        sql += f"'{cudate}', '{cudate}');\n"

                    purchase_by_seller_id += 1
                total_price = round(total_price, 2)
                sql += f"UPDATE purchases SET total_price = {
                    total_price} WHERE id = {purchase_id};\n"
                purchase_id += 1
        sql += "COMMIT;"
        file.write(sql)
