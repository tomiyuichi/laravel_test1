# Sample Markdown File 2

This is a sample Markdown file.

- Item 7
- Item 8
- Item 9

- [sample_0](sample) 
- [sample_1](sample_1)

```sql
CREATE TEMPORARY TABLE temp_table AS
SELECT MIN(id) AS id
FROM sample_table
GROUP BY col1, col2;

DELETE FROM sample_table
WHERE id NOT IN (SELECT id FROM temp_table);
```
