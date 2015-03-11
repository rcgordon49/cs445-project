import re
import collections

SOURCE_DIR = 'data/orig_data'
OUTPUT_DIR = 'data/rel_data'

regex = r"\t([^\t\n]+)"

def findCase(line):
  if line.startswith('Title'):
    return 'title'
  elif line.startswith('Year'):
    return 'year'
  elif line.startswith('Genres'):
    return 'genre'
  else:
    return None
    
def createGenreObj(g, title, year):
  genObj = collections.OrderedDict()
  genObj['title'] = title
  genObj['year'] = year
  genObj['genre'] = g
  return genObj
  
def zipObjs(genres, title, year):
  objs = []
  for g in genres:
    gobj = createGenreObj(g, title, year)
    objs.append(gobj)
    
  return objs
  
with open('%s/genre.txt' % SOURCE_DIR, 'r', encoding='latin-1') as inFile, open('%s/genres_formatted.txt' % OUTPUT_DIR, 'w+', encoding='latin-1') as genFile:
  for line in inFile:
    case = findCase(line)
    
    if case == 'title':
      title = re.findall(regex, line)[0]
    elif case == 'year':
      year = re.findall(regex, line)[0]
    elif case == 'genre':
      genres = re.findall(regex, line)
      genObjs = zipObjs(genres, title, year)
      for g in genObjs:
        genFile.write('\t'.join(g.values()) + '\n')
        
      print('(%s, %s)' % (title, year))
      print(genres)