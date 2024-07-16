from typing import Literal
from data import products
from data import lorem
import random
from datetime import datetime, timedelta

PROBALITY: int = 7
SELLER_ID_START: int = 2
SELLER_ID_END: int = 5
USER_ID_START: int = 6
USER_ID_END: int = 9
PURCHASE_PER_USER: int = 5
PURCHASE_MIN_ITEMS: int = 1
PURCHASE_MAX_ITEMS: int = 5
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

if __name__ == "__main__":

    current_datetime = datetime.now()

    formatted_datetime = current_datetime.strftime('%Y-%m-%d %H:%M:%S')

    with open("data.sql", "w", encoding="utf-8") as file:
        sql: Literal[''] = ""
        sub_cat_id = 1
        cat_id = 1
        prices: list[float] = []
        prices.append(1.1)
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
                                if random.randint(1, 10) > PROBALITY:
                                    price += FLOATING_1
                                else:
                                    price += FLOATING_2
                                counter = random.randint(
                                    PRODUCTS_IN_SHOP_MIN, PRODUCTS_IN_SHOP_MAX)
                                seller_id = random.randint(
                                    SELLER_ID_START, SELLER_ID_END)
                                sql += f"INSERT INTO products('id','name', 'description','price', 'image_path', 'counter', 'sub_category_id', 'seller_id', 'created_at', 'updated_at') VALUES (NULL,'{
                                    item_data[0] + " "+company + " " + str(count) + " " + item_data[1]}', '{lorem}', {price}, '{PICTURE}', {counter}, {sub_cat_id}, {seller_id}, '{formatted_datetime}', '{formatted_datetime}');\n"
                                prices.append(price)
                        else:
                            price: float = random.randint(
                                PRODUCT_PRICE_MIN, PRODUCT_PRICE_MAX)
                            if random.randint(1, 10) > PROBALITY:
                                price += FLOATING_1
                            else:
                                price += FLOATING_2
                            counter = random.randint(
                                PRODUCTS_IN_SHOP_MIN, PRODUCTS_IN_SHOP_MAX)
                            seller_id = random.randint(
                                SELLER_ID_START, SELLER_ID_END)
                            sql += f"INSERT INTO products('id','name', 'description','price', 'image_path', 'counter', 'sub_category_id', 'seller_id', 'created_at', 'updated_at') VALUES (NULL,'{
                                item_data[0] + " "+company + " 1 " + item_data[1]}', '{lorem}', {price}, '{PICTURE}', {counter}, {sub_cat_id}, {seller_id}, '{formatted_datetime}', '{formatted_datetime}');\n"
                            prices.append(price)
                    sub_cat_id += 1
                cat_id += 1
        purchase_id = 1
        for user_id in range(USER_ID_START, USER_ID_END+1):
            for j in range(PURCHASE_PER_USER):
                days_back = random.randint(DAYS_BACK_MIN, DAYS_BACK_MAX)
                earlier_date = datetime.now() - timedelta(days=days_back)
                cudate = earlier_date.strftime('%Y-%m-%d %H:%M:%S')
                purchase_date = earlier_date.strftime('%Y-%m-%d')
                delivery_status = random.randint(
                    DELIVERY_STATUS_ID_START, DELIVERY_STATUS_ID_END)

                delivered = True if delivery_status == DELIVERY_STATUS_ID_END else False

                sql += f"INSERT INTO purchases('id', 'date', 'user_id', 'total_price', 'created_at', 'updated_at', 'delivery_id', 'delivered') VALUES({
                    purchase_id}, '{purchase_date}', {user_id}, 1.1, '{cudate}', '{cudate}', {delivery_status}, {1 if delivered else 0});\n"

                items_in_purchase = random.randint(
                    PURCHASE_MIN_ITEMS, PURCHASE_MAX_ITEMS)

                total_price: float = 0.0
                for k in range(items_in_purchase):

                    product_id = random.randint(1, len(prices) - 1)

                    counter = random.randint(
                        PURCHASE_ITEM_COUNTER_MIN, PURCHASE_ITEM_COUNTER_MAX)

                    item_price = prices[product_id]
                    total_price += item_price * counter

                    sql += f"INSERT INTO purchase_products('id', 'purchase_id', 'product_id', 'counter', 'created_at', 'updated_at') VALUES (NULL, {
                        purchase_id}, {product_id}, {counter}, '{cudate}', '{cudate}');\n"
                total_price = round(total_price, 2)
                sql += f"UPDATE purchases SET total_price = {
                    total_price} WHERE id = {purchase_id};\n"
                purchase_id += 1
        file.write(sql)
