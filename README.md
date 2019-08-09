Паттерн Builder 
***
Является паттерном создания объектов. 
Суть его заключается в том, чтобы отделить процесс создания некоторого сложного объекта от его представления. 
Таким образом, можно получать различные представления объекта, используя один и тот же “технологический” процесс.
***
Цель:
***
Отделяет конструирование сложного объекта от его представления, так что в результате одного и того же процесса конструирования могут получаться разные представления.
***
Плюсы:
***
позволяет изменять внутреннее представление продукта;
Изолирует код, реализующий конструирование и представление;
Дает более тонкий контроль над процессом конструирования;
***
Минусы:
***
Усложняет код программы из-за введения дополнительных классов;
Клиент будет привязан к конкретным классам строителей, так как в интерфейсе строителя может не быть метода получения результата;
