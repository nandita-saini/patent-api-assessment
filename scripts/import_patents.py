import pandas as pd
from sqlalchemy import create_engine

df = pd.read_csv('dataset/patents.csv')

df.columns = [
    'publication_number',
    'title',
    'assignee',
    'filing_date',
    'publication_date',
    'patent_type'
]

# clean text columns only
text_columns = [
    'publication_number',
    'title',
    'assignee',
    'patent_type'
]

df[text_columns] = df[text_columns].fillna('')

# convert dates properly
df['filing_date'] = pd.to_datetime(
    df['filing_date'],
    errors='coerce'
)

df['publication_date'] = pd.to_datetime(
    df['publication_date'],
    errors='coerce'
)

print(df.head())
print(df.info())

engine = create_engine(
    'postgresql://postgres:password@localhost:5432/patents'
)

df.to_sql(
    'patents',
    engine,
    if_exists='append',
    index=False
)

print("Import completed successfully")