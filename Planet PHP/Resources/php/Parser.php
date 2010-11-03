class Parser
{
    public function parseFeed($xmlFeed) 
    {
        $feedItems = array();
        $sxe = new \SimpleXMLElement($xmlFeed);
        
        foreach ($sxe->entry as $entry)
        {
            $id = (string) $entry->id;
            
            $feedItems[$id] = array(
                'title' => (string) $entry->title,
                'author' => (string) $entry->author->name,
                'published' => (string) $entry->published,
                'content' => (string) $entry->content
            );
            
            foreach ($entry->link as $link)
            {
                if ((string) $link['rel'] == 'alternate')
                {
                    $feedItems[$id]['link'] = (string) $link['href'];
                }
            }
        }
        
        return json_encode($feedItems);
    }   
}